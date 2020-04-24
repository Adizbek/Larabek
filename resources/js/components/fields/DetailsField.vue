<template>
  <b-row class="py-2">
    <b-col sm="2" class="text-capitalize">
      {{field.name}}
    </b-col>

    <b-col sm="10">
      <component :field="field"
                 :data="field.data"
                 :is="field.type + '-details-field'"/>
    </b-col>
  </b-row>
</template>

<script>
  export default {
    name: "DetailsField",

    props: {
      data: {},
      field: {},
      component: {}
    }
  }
</script>

<style scoped>

</style>
