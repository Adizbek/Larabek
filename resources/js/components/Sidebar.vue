<template>
    <div class="sidebar">
        <div>
            <div class="menu">
                <div class="menu-header">Models</div>

                <router-link tag="a" :to="{name: 'list', params: {slug: entity.slug}}"
                             :key="entity.slug"
                             class="menu-item"
                             v-for="entity in entities">
                    {{entity.name}}
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import store from "../store";

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
        padding: 12px 15px;
        background: rgba(0, 0, 0, .15);
    }

    .menu-item {
        padding: 2px 15px;
        height: 44px;
        font-size: 15px;
        display: flex;
        align-items: center;

        &:hover {
            background: rgba(0, 0, 0, .1);
        }
    }
</style>
