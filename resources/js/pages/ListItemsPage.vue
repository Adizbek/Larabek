<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <div class="card my-2">
          <div class="card-header">
            <div class="float-right d-flex align-items-center">
              <div>
                <div v-for="filter in filterList">
                  <component v-model="filters[filter.key]" :is="`${filter.name}-filter`" :filter="filter"/>
                </div>
              </div>

              <div class="ml-2">
                <b-btn @click="$router.push({name: 'form', params: {entity: entity}})" variant="primary" size="sm">
                  Add new
                </b-btn>
              </div>
            </div>

            <div class="h3 mb-0 text-capitalize">{{entity}}</div>
          </div>

          <div class="card-body">
            <div class="table-responsive mb-0">
              <table class="table table-bordered table-sm">
                <thead>
                <tr>
                  <th v-for="f in fields" class="text-capitalize" style="min-width: 80px">
                    {{f.name}}
                  </th>

                  <th>Actions</th>
                </tr>
                </thead>

                <b-tbody>
                  <b-tr :key="index" v-for="(item, index) in items">
                    <b-td :key="index" v-for="(field, index) in item.fields">
                      <component :is="field.type + '-list-field'" :data="field.data" :field="field"/>
                    </b-td>

                    <b-td style="white-space: nowrap">
                      <Action :key="i" :entity="entity" :model="item.model" :action="action"
                              :last="i + 1 === actions.length"
                              v-for="(action, i) in actions"/>
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
              v-if="data.list"
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

  export default {
    name: "ListItemsPage",
    components: {Action},
    data() {
      return {
        data: [],
        filters: this.$route.query.filters ? JSON.parse(atob(this.$route.query.filters)) : {},
        query: {
          page: this.$route.query.page || '1'
        }
      }
    },

    mounted() {
      this.fetchData();
    },

    methods: {
      fetchData() {
        this.$http.post(`list/${this.entity}`, {}, {
          params: this.listParams
        }).then(res => {
          this.data = res.data
        })
      },

      applyFilter(filter, value) {
        this.$set(this.filters, filter, value);
      },

      onPageChanged(page) {
        this.$set(this.query, 'page', page);
      }
    },

    computed: {
      entity() {
        return this.$route.params.entity
      },

      items() {
        return this.data.list && this.data.list.data;
      },

      fields() {
        return this.data && this.data.fields;
      },

      actions() {
        return this.data && this.data.actions;
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
      }
    }
  }
</script>

<style scoped>

</style>
