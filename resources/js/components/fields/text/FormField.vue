<template>
  <div>
    <input v-model="localValue.text" class="form-control">
  </div>
</template>

<script>
  export default {
    name: "TextFormField",

    props: {
      value: {}
    },

    data() {
      return {
        localValue: this.value
      }
    },

    methods: {},

    watch: {
      localValue(val) {
        this.$emit('input', val);
      }
    }
  }
</script>

<style scoped>

</style>
