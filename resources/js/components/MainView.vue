<template>
    <div class="main-view">
        <router-view :key="$route.fullPath"></router-view>
    </div>
</template>

<script>
    export default {
        name: "MainView"
    }
</script>

<style scoped>
    .main-view {
        margin-left: var(--sidebar-width);
    }
</style>
