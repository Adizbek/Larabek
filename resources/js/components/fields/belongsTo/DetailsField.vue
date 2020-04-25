<template>
  <a :href="url" class="btn btn-link p-0">{{data.text}}</a>
</template>

<script>
export default {
  name: "BelongsToDetailsField",
  props: {
    data: {},
    field: {}
  },

  computed: {
    url() {
      return Larabek.navigation.resolveDetails(this.data.entity, this.data.id).href
    }
  }
}
</script>

<style scoped>

</style>
