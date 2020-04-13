import Vue from 'vue';
import VueRouter from 'vue-router'
import HomePage from "./pages/HomePage";
import ListItemsPage from "./pages/ListItemsPage";
import NotFoundPage from "./pages/NotFoundPage";

Vue.use(VueRouter);

const routes = [
    {path: '/', component: HomePage, name: 'home'},
    {path: '/list/:slug', component: ListItemsPage, name: 'list'},
    {path: '*', component: NotFoundPage}
];

export default new VueRouter({
    routes,
    mode: 'history',
    base: window.ADMIN_PREFIX
});
