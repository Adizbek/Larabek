<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12">
        <div class="card my-2">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th v-for="f in list.fields">{{f.name}}
                </th>

                <th>Actions</th>
              </tr>
              </thead>

              <b-tbody>
                <b-tr :key="index" v-for="(item, index) in list.items">
                  <b-td :key="index" v-for="(field, index) in item.fields">
                    <component :is="field.type + '-list-field'" :data="field.data" :field="field"/>
                  </b-td>

                  <b-td>
                    <Action :key="i" :entity="entity" :model="item.model" :action="action" v-for="(action, i) in list.actions"/>
                  </b-td>
                </b-tr>
              </b-tbody>
            </table>
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
        return this.$route.params.slug
      }
    }
  }
</script>

<style scoped>

</style>
