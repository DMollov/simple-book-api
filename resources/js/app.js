require('./bootstrap');

window.Vue = require('vue');

import store from "./store"
import VueRouter from "vue-router";
import routes from "./routes";

Vue.use(VueRouter);

const router = new VueRouter(routes);

const app = new Vue({
    store,
    el: '#app',
    router: router
});
