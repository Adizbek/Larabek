<template>
  <b-container fluid>
    <b-row>
      <b-col sm="12" class="mt-2">
        <div class="card">
          <div class="card-body">
            <form-field :key="field.name"
                           :field="field"
                           :data="field.data"
                           v-for="field in fields"/>
          </div>
        </div>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
  export default {
    name: "FormPage",

    data() {
      return {
        item: {}
      }
    },

    created() {
      this.loadEntity()
    },

    methods: {
      loadEntity() {
        this.$http.post(`form/${this.entity}/${this.id}`).then(res => {
          this.item = res.data
        })
      }
    },


    computed: {
      entity() {
        return this.$route.params.entity
      },

      id() {
        return this.$route.params.id
      },

      model() {
        return this.item.model
      },

      fields() {
        return this.item.fields
      },

      actions() {
        return this.item.actions
      }
    }
  }
</script>

<style scoped>

</style>
