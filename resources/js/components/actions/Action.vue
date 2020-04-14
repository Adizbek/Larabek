<template>
  <div @click="trigger" class="d-inline-block btn btn-primary mr-1">{{action.text}}</div>
</template>

<script>
  export default {
    name: "Action",
    props: {
      action: {},
      entity: String,
      model: {}
    },

    methods: {
      trigger() {
        this.$http.post(`action/${this.entity}`, {
          action: this.action.name,
          data: [],
          models: [this.model.id]
        }).then(res => {
          console.log(res.data)
        })
      }
    }
  }
</script>

<style scoped>

</style>
