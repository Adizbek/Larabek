<template>
  <b-form-checkbox disabled switch size="lg" :checked="data.checked">
    {{field.name}}
  </b-form-checkbox>
</template>

<script>
  export default {
    name: "SwitchListField",

    props: {
      data: {},
      field: {}
    }
  }
</script>

<style scoped>

</style>
