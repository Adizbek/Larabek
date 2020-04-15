import Vue from 'vue';
import VueRouter from 'vue-router'
import HomePage from "./pages/HomePage";
import ListItemsPage from "./pages/ListItemsPage";
import NotFoundPage from "./pages/NotFoundPage";
import DetailsPage from "./pages/DetailsPage";
import FormPage from "./pages/FormPage";

Vue.use(VueRouter);

const routes = [
    {path: '/', component: HomePage, name: 'home'},
    {path: '/list/:entity', component: ListItemsPage, name: 'list'},
    {path: '/details/:entity/:id', component: DetailsPage, name: 'details'},
    {path: '/form/:entity/:id?', component: FormPage, name: 'form'},
    {path: '*', component: NotFoundPage}
];

export default new VueRouter({
    routes,
    mode: 'history',
    base: window.ADMIN_PREFIX
});
