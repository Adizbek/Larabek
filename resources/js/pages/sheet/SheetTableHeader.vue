<template>
  <component :is="tag" class="text-capitalize" style="min-width: 80px" @click="updateSorting">
    {{field.name}}

    <span v-if="field.sortable"><Icon :icon="sortIcon"/></span>
  </component>
</template>

<script>
import Icon from "../../components/admin/Icon";

export default {
  name: "SheetTableHeader",
  components: {Icon},
  props: {
    tag: {
      type: String,
      default: 'th'
    },

    field: {}
  },

  data() {
    return {
      direction: this.field.sortable && this.field.sortable.direction,
      directions: ['asc', 'desc', null]
    }
  },

  methods: {
    updateSorting() {
      if (!this.field.sortable)
        return;

      this.direction = this.directions[(this.directions.findIndex(x => x === this.direction) + 1) % this.directions.length]

      this.$emit('sort', this.field, this.direction);
    }
  },

  computed: {
    isSortable() {
      return !!this.field.sortable
    },

    sortIcon() {
      if (this.isSortable) {
        switch (this.direction) {
          case 'asc':
            return 'sort-up'

          case 'desc':
            return 'sort-down'

          default:
            return 'sort'
        }
      } else {
        return null;
      }
    }
  }
}
</script>

<style scoped>

</style>
