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
    import Sidebar from "./components/Sidebar";
    import MainView from "./components/MainView";
    import Navbar from "./components/Navbar";
    import Footer from "./components/Footer";

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
        min-height: calc(100% - 50px);
    }
</style>
