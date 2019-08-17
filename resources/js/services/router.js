import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/views/Index'
import Parent from '@/views/Parent'
import Login from '@/views/auth/Login'
import Logout from '@/views/auth/Logout'
import Setup from '@/views/auth/Setup'
import Register from '@/views/auth/Register'
import GoogleCallback from '@/views/auth/GoogleCallback'

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
            path: '/auth/logout',
            component: Logout,
            name: 'auth.logout',
        },
        {
            path: '/auth/login/google/return',
            component: GoogleCallback,
            name: 'auth.login.google.return',
        },
        {
            path: '/auth/register',
            component: Register,
            name: 'auth.register',
        },
        {
            path: '/auth/setup',
            component: Setup,
            name: 'auth.setup',
        },
        {
            path: '/planets',
            component: Parent,
            children: [
                {
                    path: '',
                    component: Index,
                    name: 'planets.index',
                },
                {
                    path: '/planets/:id',
                    component: Index,
                    name: 'planets.view',
                },
            ],
        },
    ]
});
