
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import router from './router.js'
import store from './store.js'

const app = new Vue({
    router,
    store,
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
