import Vue from "vue";
import VueRouter from "vue-router";

import AuthLayout from "../layouts/AuthLayout.vue";
import MainLayout from "../layouts/MainLayout.vue";

import Login from "../views/Auth/Login.vue";
import Registry from "../views/Auth/Registry.vue";
import EncodePage from "../views/Pages/EncodePage.vue";
import DecodePage from "../views/Pages/DecodePage.vue";

Vue.use(VueRouter);

const routes = [
    {
        path: '/auth',
        component: AuthLayout,
        children: [
            {
                path: 'login',
                name: 'login',
                component: Login,
                props: true,
                meta: {

                }
            },
            {
                path: 'registry',
                name: 'registry',
                component: Registry,
                props: true,
                meta: {

                }
            },
        ]
    },
    {
        path: '/',
        component: MainLayout,
        children: [
            {
                path: 'encode',
                name: 'encode',
                component: EncodePage,
                props: true,
                meta: {

                }
            },
            {
                path: 'decode',
                name: 'decode',
                component: DecodePage,
                props: true,
                meta: {

                }
            }
        ]
    }
];

const router = new VueRouter({
    mode: 'history',
    routes,
});

export default router;
