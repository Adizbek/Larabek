<template>
  <div>
    <b-form-select v-model="currentValue" :options="options" size="sm"/>
  </div>
</template>

<script>
  import FilterMixin from "../mixins/FilterMixin";

  export default {
    name: "PaginationFilter",

    mixins: [FilterMixin],

    computed: {
      options() {
        return this.filterData.options.reduce((arr, item, index) => {
          arr.push({
            value: index,
            text: item
          })

          return arr;
        }, [])
      }
    }
  }
</script>

<style scoped>

</style>
