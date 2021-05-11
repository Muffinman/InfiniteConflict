import Vue from 'vue'
import Vuex from 'vuex'
import VuexPersist from 'vuex-persist'

Vue.use(Vuex);

const vuexPersist = new VuexPersist({
    key: 'ic',
    storage: localStorage
});

export default new Vuex.Store({
    plugins: [vuexPersist.plugin],
    state: {
        accessToken: null,
        user: null,
        planets: [],
    },
    getters: {
        getAccessToken: state => {
            return state.accessToken
        },
        getUser: state => {
            return state.user
        },
        getPlanets: state => {
            return state.planets
        },
    },
    mutations: {
        setAccessToken: (state, tokenValue) => {
            state.accessToken = tokenValue;
        },
        setUser: (state, userValue) => {
            state.user = userValue;
        },
        removeAccessToken: (state) => {
            state.accessToken = null;
        },
        removeUser: (state) => {
            state.user = null;
        },
        setPlanets: (state, planets) => {
            state.planets = planets;
        },
    }
})
