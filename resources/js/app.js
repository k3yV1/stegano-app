import './bootstrap';
import Vue from 'vue';
import App from "../vue/App.vue";
import router from "../vue/router";

new Vue({
    router,
    render: h => h(App),
}).$mount('#app');
