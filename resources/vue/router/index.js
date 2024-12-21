import Vue from "vue";
import VueRouter from "vue-router";

import Login from "../views/Auth/Login.vue";
import Registry from "../views/Auth/Registry.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: '/login',
        name: 'login',
        component: Login,
        props: true,
        meta: {

        }
    },
    {
        path: '/registry',
        name: 'registry',
        component: Registry,
        props: true,
        meta: {

        }
    }
];

const router = new VueRouter({
    mode: 'history', // Вмикає режим історії (чисті URL без #)
    routes,
});

export default router;
