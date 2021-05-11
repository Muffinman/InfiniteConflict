import Vue from 'vue'
import VueRouter from 'vue-router'

import Index from '@/views/Index'
import Parent from '@/views/Parent'
import Login from '@/views/auth/Login'
import Logout from '@/views/auth/Logout'
import Setup from '@/views/auth/Setup'
import Register from '@/views/auth/Register'
import Forgot from '@/views/auth/Forgot'
import GoogleCallback from '@/views/auth/GoogleCallback'

import PlanetView from '@/views/planets/PlanetView'
import PlanetIndex from '@/views/planets/PlanetIndex'
import FleetIndex from "@/views/fleets/FleetIndex";
import NavIndex from "@/views/nav/NavIndex";
import ResearchIndex from "@/views/research/ResearchIndex";
import AllianceIndex from "@/views/alliances/AllianceIndex";
import NavGalaxyView from "@/views/nav/NavGalaxyView";
import FleetView from "@/views/fleets/FleetView";
import AllianceView from "@/views/alliances/AllianceView";

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
            path: '/auth/forgot',
            component: Forgot,
            name: 'auth.forgot',
        },
        {
            path: '/planets',
            component: Parent,
            children: [
                {
                    path: '',
                    component: PlanetIndex,
                    name: 'planets.index',
                },
                {
                    path: '/planets/:id',
                    component: PlanetView,
                    name: 'planets.view',
                },
            ],
        },
        {
            path: '/fleets',
            component: Parent,
            children: [
                {
                    path: '',
                    component: FleetIndex,
                    name: 'fleets.index',
                },
                {
                    path: '/fleets/:id',
                    component: FleetView,
                    name: 'fleets.view',
                },
            ],
        },
        {
            path: '/nav',
            component: Parent,
            children: [
                {
                    path: '',
                    component: NavIndex,
                    name: 'nav.index',
                },
                {
                    path: '/nav/:galaxy',
                    component: NavGalaxyView,
                    name: 'nav.galaxy.view',
                },
                {
                    path: '/nav/:galaxy/:system',
                    component: NavGalaxyView,
                    name: 'nav.system.view',
                },
            ],
        },
        {
            path: '/research',
            component: Parent,
            children: [
                {
                    path: '',
                    component: ResearchIndex,
                    name: 'research.index',
                },
            ],
        },
        {
            path: '/alliances',
            component: Parent,
            children: [
                {
                    path: '',
                    component: AllianceIndex,
                    name: 'alliances.index',
                },
                {
                    path: '/alliances/:id',
                    component: AllianceView,
                    name: 'alliances.view',
                },
            ],
        },
    ]
});
