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
        auth: {
            access_token: null,
            expires_in: null,
            token_type: null,
        },
        user: {

        }
    },
    getters: {
        getAuth: state => {
            return state.auth
        },
        getUser: state => {
            return state.user
        }
    },
    mutations: {
        setAuth: (state, authValue) => {
            Object.assign(state.auth, authValue);
        },
        setUser: (state, userValue) => {
            Object.assign(state.user, userValue);
        }
    }
})