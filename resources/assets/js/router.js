import Vue from 'vue'
import VueRouter from 'vue-router';
import Index from './Index.vue'
import Login from './components/Login.vue'

Vue.use(VueRouter);

export default new VueRouter({
    mode: 'history',
    base: '/',
    routes: [
        {
            path: '/',
            component: Index,
            name: 'index'
        },
        {
            path: '/login',
            component: Login,
            name: 'login'
        },
    ]
});