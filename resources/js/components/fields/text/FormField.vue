<template>
  <div>
    <input :value="value" @input="onInput" class="form-control">
  </div>
</template>

<script>
  export default {
    name: "TextFormField",

    props: {
      value: {}
    },

    methods: {
      onInput(data) {
        this.$emit('input', data);
      }
    }
  }
</script>

<style scoped>

</style>
