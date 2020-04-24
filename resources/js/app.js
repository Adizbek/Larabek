import Vue from "vue";
import {BootstrapVue} from 'bootstrap-vue'

import AdminApp from "./AdminApp";
import router from "./router";
import axios from 'axios';

Vue.use(BootstrapVue);

axios.defaults.baseURL = '/' + window.ADMIN_PREFIX + '/api';
Vue.prototype.$http = axios;


import './components'
import './core/Larabek'
import LToast from "./core/LToast";

let app = new Vue({
    // i18n,
    router,
    // store,
    render: h => h(AdminApp)
});

LToast.toaster = app;

window.vm = app.$mount('#admin');
