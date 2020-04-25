<template>
  <div>
    <b-form-select v-model="localValue.id" :options="field.items" text-field="text" value-field="id"></b-form-select>
  </div>
</template>

<script>
import FieldMixin from "../../mixins/FieldMixin";

export default {
  name: "BelongsToFormField",

  mixins: [FieldMixin],



}
</script>

<style scoped>

</style>
