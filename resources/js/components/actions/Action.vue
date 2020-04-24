<template>
  <div @click="trigger" class="badge badge-light action"
       :class="{'mr-1': !last,'justify-content-center': !action.showText}">
    <Icon v-if="action.showIcon && action.icon" :icon="action.icon"
          :class="{'mr-1': action.showText}"/>
    <span v-if="action.showText">{{action.text}}</span>
  </div>
</template>

<script>

  import {LarabekEvents} from "../../core/consts";
  import ActionConfirmation from "./ActionConfirmation";
  import Icon from "../admin/Icon";

  export default {
    name: "Action",
    components: {Icon},
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
          if (this.needConfirm) {
            this.askConfirmation(this.processDefaultAction);
          } else {
            this.processDefaultAction();
          }
        }
      },

      async processDefaultAction() {
        let models = Array.isArray(this.model) ? this.model.map(x => x.id) : [this.model.id]

        this.$http.post(`action/${this.entity}/${this.action.name}`, {
          action: this.action.name,
          data: [],
          models
        }).then(res => {
          Larabek.emit(LarabekEvents.AfterActionDone, this.entity, this.action, this.model);

          console.log(res.data)
        })
      },

      /**
       * @param {?function} onAllowed
       */
      askConfirmation(onAllowed) {
        this.$modal.show(ActionConfirmation, {
          onAllowed,
          confirmation: this.action.confirm
        }, {
          height: 'auto',
          clickToClose: true
        })
      }

    },

    computed: {
      isDetailsAction() {
        return this.action.name === 'details-action'
      },

      isEditAction() {
        return this.action.name === 'edit-action'
      },

      needConfirm() {
        return true;
      }
    }
  }
</script>

<style scoped lang="scss">
  .action {
    display: flex;
    align-items: center;
    font-size: 16px;
    height: 31px;
    min-width: 31px;
    border: 1px solid #dee2e6;
    cursor: pointer;
    opacity: .7;

    &:hover {
      opacity: 1;
    }
  }
</style>
