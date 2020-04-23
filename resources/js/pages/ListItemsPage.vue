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
                  <th v-for="f in list.fields" class="text-capitalize" style="min-width: 80px">
                    {{f.name}}
                  </th>

                  <th>Actions</th>
                </tr>
                </thead>

                <b-tbody>
                  <b-tr :key="index" v-for="(item, index) in list.items">
                    <b-td :key="index" v-for="(field, index) in item.fields">
                      <component :is="field.type + '-list-field'" :data="field.data" :field="field"/>
                    </b-td>

                    <b-td style="white-space: nowrap">
                      <Action :key="i" :entity="entity" :model="item.model" :action="action"
                              :last="i + 1 === list.actions.length"
                              v-for="(action, i) in list.actions"/>
                    </b-td>
                  </b-tr>
                </b-tbody>
              </table>
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
        list: []
      }
    },

    mounted() {
      this.$http.post(`list/${this.entity}`, {}, {
        params: this.$route.query
      }).then(res => {
        this.list = res.data
      })
    },

    computed: {
      entity() {
        return this.$route.params.entity
      }
    }
  }
</script>

<style scoped>

</style>
