<template>
  <b-navbar class="navbar" type="dark" variant="dark">
    <b-navbar-brand :to="{name: 'home'}">Larabek</b-navbar-brand>
  </b-navbar>
</template>

<script>
  export default {
    name: "Navbar"
  }
</script>

<style scoped>
  .navbar {
    position: fixed;
    z-index: 2;
    width: 100%;
    max-height: 50px;
    min-height: 50px;
  }
</style>
