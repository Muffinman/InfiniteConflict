<template>
    <b-modal :active="true">
        <header class="modal-card-head">
            <h2 class="modal-card-title">Register</h2>
            <router-link class="button is-primary" :to="{ name: 'auth.login' }">Login</router-link>
            <router-link class="button is-primary" :to="{ name: 'auth.forgot' }">Forgot your password?</router-link>
        </header>
        <div class="stripe"></div>
        <section class="modal-card-body">
            <b-field label="Email">
                <b-input type="email" v-model="email"></b-input>
            </b-field>

            <b-field label="Password">
                <b-input v-model="password" type="password" value="" password-reveal></b-input>
            </b-field>

            <button class="button is-primary pull-right" @click="register">Register</button>
        </section>
        <footer class="modal-card-foot">
            <a @click="loginWithGoogle"><img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png"></a>
        </footer>
    </b-modal>
</template>

<script>
    export default {
        data() {
          return {
              email: '',
              password: '',
          }
        },
        mounted() {
            if (this.$store.getters.getAccessToken) {
                this.$router.replace('/');
            }
        },
        methods: {
            register() {
                let that = this;
                axios.post('/register', { email: this.email, password: this.password, device_name: 'ic_web_ui'}).then(response => {
                    that.$store.commit('setAccessToken', null);
                    that.$router.replace({ name: 'auth.login' });
                })
            },
            loginWithGoogle() {
                axios.get('/auth/login/google').then((response) => {
                    if (response.data.redirect) {
                        window.location = response.data.redirect;
                    }
                });
            }
        }
    }
</script>
