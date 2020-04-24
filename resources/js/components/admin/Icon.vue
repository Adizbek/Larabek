<template>
  <font-awesome-icon :size="size" :icon="iconType"/>
</template>

<script>
  export default {
    name: 'Icon',

    props: {
      type: {
        type: String,
        default: 'fas'
      },

      size: {
        type: String,
        default: 'sm'
      },

      icon: {}
    },

    computed: {
      iconType () {
        if (Array.isArray(this.icon)) {
          return this.icon
        }

        return [this.type, this.icon]
      }
    }
  }
</script>

<style scoped>

</style>
