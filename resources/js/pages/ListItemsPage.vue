<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <div class="card my-2">
          <div class="card-header">
            <div class="float-right d-flex align-items-center" v-if="data">
              <Action :key="i" :entity="entity" :model="selectedItemModels" :action="action"
                      v-for="(action, i) in batchActions"/>

              <div v-for="filter in filterList" class="mx-1">
                <component v-model="filters[filter.key]" :is="`${filter.name}-filter`" :filter="filter"/>
              </div>

              <div class="ml-1">
                <b-btn @click="$router.push({name: 'form', params: {entity: entity}})" variant="primary" size="sm">
                  Add new
                </b-btn>
              </div>
            </div>

            <div class="h3 mb-0 text-capitalize">{{entity}}</div>
          </div>

          <div class="card-body p-0">
            <div class="table-responsive mb-0">
              <table class="table table-hover table-list">
                <thead>
                <tr>
                  <th class="pl-4" width="60px">
                    <b-form-checkbox @change="toggleAll" :checked="allAreSelected" ref="checkAll" size="lg"/>
                  </th>

                  <th v-for="f in fields" class="text-capitalize" style="min-width: 80px">
                    {{f.name}}
                  </th>

                  <th></th>
                </tr>
                </thead>

                <b-tbody>
                  <b-tr :key="index" v-for="(item, index) in items">
                    <b-td class="pl-4">
                      <b-form-checkbox v-model="item._selected" size="lg"/>
                    </b-td>

                    <b-td :key="index" v-for="(field, index) in item.fields">
                      <component :is="field.type + '-list-field'" :data="field.data" :field="field"/>
                    </b-td>

                    <b-td style="white-space: nowrap">
                      <div class="d-flex justify-content-end">
                        <Action :key="i" :entity="entity" :model="item.model" :action="action"
                                :last="i + 1 === actions.length"
                                v-for="(action, i) in actions"/>
                      </div>
                    </b-td>
                  </b-tr>
                </b-tbody>
              </table>
            </div>
          </div>

          <div class="card-footer d-flex align-items-center">
            <b-pagination
              size="sm"
              class="mb-0 flex-grow-1"
              v-if="data"
              :value="data.list.current_page"
              @input="onPageChanged"
              :total-rows="data.list.total"
              :per-page="data.list.per_page"
            />

            <div class="float-right d-flex align-items-center">
              Showing {{paginationInfo.from}} to {{paginationInfo.to}} of {{paginationInfo.total}} entities
            </div>
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  import Action from "../components/actions/Action";
  import {LarabekEvents} from "../core/consts";

  const uniqueId = require('lodash.uniqueid');

  export default {
    name: "ListItemsPage",
    components: {Action},
    data() {
      return {
        data: null,
        filters: this.$route.query.filters ? JSON.parse(atob(this.$route.query.filters)) : {},
        query: {
          page: this.$route.query.page || '1'
        },
        selectedItems: []
      }
    },

    mounted() {
      this.fetchData();

      Larabek.addListener(LarabekEvents.AfterActionDone, this.afterActionDone)
    },

    beforeDestroy() {
      Larabek.removeListener(LarabekEvents.AfterActionDone, this.afterActionDone)
    },


    methods: {
      fetchData() {
        this.$http.post(`list/${this.entity}`, {}, {
          params: this.listParams
        }).then(res => {
          /** @type Object[] */
          let items = res.data.list.data;

          items.forEach((item) => {
            item._id = uniqueId('list_item_')
          })

          this.data = res.data

        })
      },

      applyFilter(filter, value) {
        this.$set(this.filters, filter, value);
      },

      onPageChanged(page) {
        this.$set(this.query, 'page', page);
      },

      afterActionDone(entity, action, model) {
        if (entity === this.entity) {
          this.fetchData()
        }
      },

      toggleAll(val) {
        this.items.forEach((i) => {
          this.$set(i, '_selected', val)
        })

        this.$forceUpdate();
      }
    },

    computed: {
      entity() {
        return this.$route.params.entity
      },

      /** @type Object[] */
      items() {
        return this.data && this.data.list && this.data.list.data;
      },

      fields() {
        return this.data && this.data.fields;
      },

      actions() {
        return this.data && this.data.actions;
      },

      batchActions() {
        return this.actions.filter(x => x.batch)
      },

      filterList() {
        return this.data && this.data.filters;
      },

      encodedFilters() {
        return this.appliedFiltersCount > 0 ? btoa(JSON.stringify(this.filters)) : undefined
      },

      appliedFiltersCount() {
        return Object.keys(this.filters).length
      },

      listParams() {
        return {
          ...this.$route.query,
          ...this.query,
          filters: this.encodedFilters
        }
      },

      paginationInfo() {
        try {
          let pp = this.data.list.per_page;
          let cp = this.data.list.current_page;
          let total = this.data.list.total;

          return {
            from: pp * (cp - 1) + 1,
            to: Math.min(pp * cp, total),
            total
          }
        } catch (e) {
          return {}
        }
      },

      pagination() {

      },

      allAreSelected() {
        try {
          return this.items.length === this.selectedItems.length
        } catch (e) {
          return false;
        }
      },

      selectedItemModels() {
        return this.selectedItems.map(x => x.model)
      }
    },

    watch: {
      listParams: {
        deep: true,
        handler(query) {
          let location = this.$router.resolve({
            query
          })

          window.history.replaceState({}, null, location.href)

          this.fetchData();
        }
      },

      items: {
        deep: true,
        handler(items) {
          this.selectedItems = items.filter(i => i._selected);
        }
      }
    }
  }
</script>

<style scoped>
  .table-list td {
    vertical-align: middle;
  }

  .table-list thead th {
    vertical-align: middle;
  }
</style>
