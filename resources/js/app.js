
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('@/services/bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import Buefy from 'buefy'
import App from '@/App.vue'

Vue.use(Buefy)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from '@/services/router.js'
import store from '@/services/store.js'

const app = new Vue({
    router,
    store,
    render: h => h(App),
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.$store.getters.getAuth.access_token;

        let that = this;
        axios.get('/api/ping').catch(error => {
            that.$store.commit('setUser', {});
            that.$store.commit('setAuth', {});
            that.$router.replace('/login');
        });
    }
}).$mount('#app');
