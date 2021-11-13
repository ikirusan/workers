
require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router'
import Vuelidate from 'vuelidate'

Vue.use(VueRouter)
Vue.use(Vuelidate)

import App from './components/App';
import Index from "./components/Index";
import Add from "./components/Add";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'index',
            component: Index
        },
        {
            path: '/add',
            name: 'add',
            component: Add
        },
        {
            path: '/edit/:workerId',
            name: 'edit',
            component: Add,
            props: true
        }
    ]
});

const app = new Vue({
    el: '#app',
    components: {App},
    router
});
