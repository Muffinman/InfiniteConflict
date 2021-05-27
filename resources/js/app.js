
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
import Swal from 'sweetalert2'

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
    created() {

        // Intercept requests to add Authorisation tokens
        axios.interceptors.request.use((config) => {
            this.ajaxRequests++;
            if (this.$store.getters.getAccessToken) {
                config.headers['Authorization'] = 'Bearer ' + this.$store.getters.getAccessToken
            }
            return config;
        }, (error) => {
            this.ajaxRequests++;
            return Promise.reject(error);
        });

        // Intercept responses to handle errors
        axios.interceptors.response.use((response) => {
            this.ajaxRequests--;
            return response;
        }, (error) => {

            // If we had a 401 then likely our access token has expired, attempt to refresh
            if (error.response.data.statusCode === 401) {
                this.refreshToken();
            }

            // 500 error is probably something more serious, alert user
            if (error.response.data.statusCode === 500) {
                if (error.response.data.data.code === 50001) {
                    Swal.fire({
                        'title': 'API Rate Limit',
                        'text': 'You sent too many requests in a short period of time, maybe take a break for a bit?',
                        'type': 'error',
                    });
                } else {
                    Swal.fire({
                        'title': 'API Error',
                        'text': error.response.data.message,
                        'type': 'error',
                    });
                }
            }

            this.ajaxRequests--;
            return Promise.reject(error);
        });


    },
    data() {
        return {
            ajaxRequests: 0,
            refreshingToken: false,
            keepAliveTimer: null,
            csrf: false,
        }
    },
    mounted() {
        this.initializeCSRF();
    },
    computed: {
        user() {
            return this.$store.getters.getUser;
        }
    },
    methods: {
        initializeCSRF() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                this.updateUser();
            });
        },
        updateUser() {
            axios.get('/auth/me').then(response => {
                this.$store.commit('setUser', response.data.data);

                if (response.data.data.planet_count === 0) {
                    this.$router.replace({ name: 'auth.setup' });
                }
            }).catch((error) => {
                this.$router.replace({name: 'auth.login'});
            });
        },
    }
}).$mount('#app');
