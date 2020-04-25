<template>
  <div class="app-wrapper">
    <Navbar/>
    <Sidebar/>

    <div class="main-view-wrapper">
      <MainView class="flex-grow-1"/>
      <Footer/>
    </div>

  </div>
</template>

<script>
import Sidebar from "./components/admin/Sidebar";
import MainView from "./components/admin/MainView";
import Navbar from "./components/admin/Navbar";
import Footer from "./components/admin/Footer";

export default {
  name: "App",
  components: {Footer, Navbar, MainView, Sidebar},

  mounted() {
  }
}
</script>

<style scoped>
  .app-wrapper {
    height: 100vh;
  }

  .main-view-wrapper {
    padding-top: 50px;
    background: #eee;
    display: flex;
    flex-direction: column;
    min-height: 100%;
  }
</style>
