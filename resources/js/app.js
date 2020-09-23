require('./bootstrap');

window.Vue = require('vue');

import store from "./store"
import VueRouter from "vue-router";
import routes from "./routes";

Vue.use(VueRouter);

const router = new VueRouter(routes);

router.beforeEach((to,from,next) => {
    if(to.matched.some(route => route.meta.requiresAuth)){
        if(localStorage.getItem('accessToken')) return next();

        return next('/');
    }else if(to.matched.some(route => route.meta.onlyGuest)) {
        if(localStorage.getItem('accessToken')) return next('/');
        else return next();
    }

    next();
});

const app = new Vue({
    store,
    el: '#app',
    router: router
});
