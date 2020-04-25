<template>
  <router-link :to="url" class="btn btn-link p-0">{{data.text}}</router-link>
</template>

<script>
export default {
  name: "BelongsToListField",

  props: {
    data: {},
    field: {}
  },

  computed: {
    url() {
      return Larabek.navigation.resolveDetails(this.field.entity, this.data.id).location
    }
  }
}
</script>

<style scoped>

</style>
