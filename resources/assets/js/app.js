
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex';
import VueRouter from 'vue-router';

Vue.use(Vuex);
Vue.use(VueRouter);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Index from './Index.vue';
import Login from './components/Login.vue';

Vue.component('index', Index);
Vue.component('login', Login);

const routes = [
    { path: '/', component: Index, name: 'index' },
    { path: '/login', component: Login, name: 'login' },
];

const router = new VueRouter({
    routes // short for `routes: routes`
});

const store = new Vuex.Store({
    state: {
        auth: {
            token: ''
        }
    },
    getters: {
        getAuth: state => {
            return state.auth
        }
    },
    mutations: {
        set (authValues) {
            state.auth = authValues;
        }
    }
});

const app = new Vue({
    router,
    store,
    mounted() {

        window.axios.defaults.headers.common['Authorisation'] = 'Bearer ' + store.getters.getAuth.token;

        let that = this;
        axios.get('/api/ping').catch(error => {
            that.$router.replace('/login');
        });
    }
}).$mount('#app');
