<template>
  <div class="card">
    <div class="card-header font-weight-bold">{{confirmation.title}}</div>

    <div class="card-body">
      {{confirmation.message}}
    </div>

    <div class="card-footer text-right">
      <b-btn class="btn btn-danger btn-sm" @click="$emit('close')">{{confirmation.cancel}}</b-btn>
      <b-btn class="btn btn-success btn-sm" @click="onConfirmed">{{confirmation.ok}}</b-btn>
    </div>
  </div>
</template>

<script>
  export default {
    name: "ActionConfirmation",

    props: {
      onAllowed: Function,
      confirmation: {}
    },

    methods: {
      async onConfirmed() {
        this.onAllowed && await this.onAllowed();

        this.$emit('close');
      }
    }
  }
</script>

<style scoped>

</style>
