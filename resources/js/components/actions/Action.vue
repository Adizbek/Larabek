<template>
  <div @click="trigger" class="d-inline-block btn btn-primary btn-sm" :class="{'mr-1': !last}">{{action.text}}</div>
</template>

<script>

  import {LarabekEvents} from "../../core/consts";

  export default {
    name: "Action",
    props: {
      action: {
        type: Object,
        required: true
      },

      entity: {
        type: String,
        required: true
      },

      model: {},

      last: {
        default: false,
        required: false,
        type: Boolean
      }
    },

    methods: {
      trigger() {
        Larabek.emit(LarabekEvents.Action, this.entity, this.action, this.model);

        if (this.isDetailsAction) {
          Larabek.navigation.openDetails(this.entity, this.model.id);
        } else if (this.isEditAction) {
          Larabek.navigation.openForm(this.entity, this.model.id)
        } else {
          this.processDefaultAction();
        }
      },

      processDefaultAction() {
        this.$http.post(`action/${this.entity}/${this.action.name}`, {
          action: this.action.name,
          data: [],
          models: [this.model.id]
        }).then(res => {
          console.log(res.data)
        })
      }
    },

    computed: {
      isDetailsAction() {
        return this.action.name === 'details-action'
      },

      isEditAction() {
        return this.action.name === 'edit-action'
      }
    }
  }
</script>

<style scoped>

</style>
