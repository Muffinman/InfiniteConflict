import Vue from 'vue'
import VueRouter from 'vue-router';

import Index from '@/templates/Index';
import Login from '@/templates/auth/Login'
import Register from '@/templates/auth/Register'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {
            path: '/',
            component: Index,
            name: 'index',
        },
        {
            path: '/auth/login',
            component: Login,
            name: 'auth.login',
        },
        {
            path: '/auth/register',
            component: Register,
            name: 'auth.register',
        },
    ]
});
