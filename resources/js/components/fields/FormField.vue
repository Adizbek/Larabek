<template>
  <b-row class="py-2">
    <b-col sm="2">
      {{field.name}}
    </b-col>

    <b-col sm="10">
      <component :field="field"
                 v-model="field.data"
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
