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
        user: null
    },
    getters: {
        getAccessToken: state => {
            return state.accessToken
        },
        getUser: state => {
            return state.user
        }
    },
    mutations: {
        setAccessToken: (state, tokenValue) => {
            state.accessToken = tokenValue;
        },
        setUser: (state, userValue) => {
            state.user = userValue;
        },
        removeAuth: (state) => {
            state.token = null;
        },
        removeUser: (state) => {
            state.user = null;
        },
    }
})
