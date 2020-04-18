<template>
  <div class="sidebar">
    <div>
      <div class="menu">
        <div class="menu-header">Models</div>

        <router-link tag="a" :to="{name: 'list', params: {entity: entity.name}}"
                     :key="entity.name"
                     class="menu-item"
                     active-class="menu-item-active"
                     v-for="entity in entities">
          {{entity.displayName}}
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
  import store from "../../store";

  export default {
    name: "Sidebar",

    mounted() {
      this.$http.post('entities').then(res => {
        store.entities = res.data
      })
    },

    computed: {
      entities() {
        return store.entities;
      }
    }
  }
</script>

<style lang="scss" scoped>
  .menu-header {
    font-weight: bold;
    font-size: 17px;
    padding: 4px 15px;
    /*background: rgba(0, 0, 0, .15);*/
  }

  .menu-item {
    padding: 2px 15px;
    height: 44px;
    font-size: 15px;
    display: flex;
    align-items: center;
    text-decoration: none;

    &:hover, &-active {
      background: rgba(0, 0, 0, .04);
    }
  }
</style>
