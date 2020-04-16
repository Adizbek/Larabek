<template>
  <b-row class="py-2">
    <b-col sm="2">
      {{field.name}}
    </b-col>

    <b-col sm="10">
      <component :field="field"
                 :data="field.data"
                 :value="field.data.text"
                 @input="d => $emit('input', d)"
                 :is="field.type + '-form-field'"/>
    </b-col>
  </b-row>
</template>

<script>
  export default {
    name: "FormField",

    props: {
      data: {},
      field: {},
      component: {},
      value: {}
    }
  }
</script>

<style scoped>

</style>
