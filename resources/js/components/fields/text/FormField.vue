<template>
  <div>
    <input v-model="localValue.text" class="form-control">
  </div>
</template>

<script>
  import FieldMixin from "../../mixins/FieldMixin";

  export default {
    name: "TextFormField",

    mixins: [FieldMixin],

    watch: {
      localValue(val) {
        this.$emit('input', val);
      }
    }
  }
</script>

<style scoped>

</style>
