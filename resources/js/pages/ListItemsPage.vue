<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <div class="card my-2">
          <div class="card-body">
            <div class="h3 mb-2 text-capitalize">{{entity}}</div>
            <div>
              <b-btn @click="$router.push({name: 'form', params: {entity: entity}})">Add new</b-btn>
            </div>

            <div>
              <div v-for="filter in filterList">
                <component v-model="filters[filter.key]" :is="`${filter.name}-filter`" :filter="filter"/>
              </div>
            </div>

            <div class="table-responsive">
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

            <b-pagination
              v-if="data.list"
              align="center"
              :value="data.list.current_page"
              @input="onPageChanged"
              :total-rows="data.list.total"
              :per-page="data.list.per_page"
            />
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
