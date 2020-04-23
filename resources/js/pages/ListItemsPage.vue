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
        filters: {},
        query: {
          page: this.$route.query.page || '1'
        }
      }
    },

    created() {
      this.fetchData();
    },

    methods: {
      fetchData() {
        this.$http.post(`list/${this.entity}`, {}, {
          params: this.query
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

      encodedFilters() {
        return atob(JSON.stringify(this.filters))
      },

      listParams() {
        return {
          ...this.$route.query,
          filter: this.filters
        }
      },

      pagination() {

      }
    },

    watch: {
      query: {
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
