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
              </tr>
              </thead>

              <b-tbody>
              <b-tr :key="index" v-for="(item, index) in list.items">
                <b-td :key="index" v-for="(field, index) in item">
                  <component :is="field.type + '-list-field'" :data="field.data" :field="field"/>
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
  export default {
    name: "ListItemsPage",
    data() {
      return {
        list: []
      }
    },

    mounted() {
      this.$http.post(`list/${this.$route.params.slug}`).then(res => {
        this.list = res.data
      })
    }
  }
</script>

<style scoped>

</style>
