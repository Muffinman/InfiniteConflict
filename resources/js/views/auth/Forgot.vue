<template>
    <b-modal :active="true">
        <header class="modal-card-head">
            <h2 class="modal-card-title">Reset your password</h2>
            <router-link class="button is-primary" :to="{ name: 'auth.login' }">Login</router-link>
        </header>
        <div class="stripe"></div>
        <section class="modal-card-body">
            <b-field label="Email">
                <b-input type="email" v-model="email"></b-input>
            </b-field>

            <p class="is-clearfix"><button class="button is-primary pull-right" @click="reset">Reset Password</button></p>
        </section>
        <footer class="modal-card-foot">
            <a @click="loginWithGoogle"><img src="https://developers.google.com/identity/images/btn_google_signin_light_normal_web.png"></a>
        </footer>
    </b-modal>
</template>

<script>
import Swal from 'sweetalert2/src/sweetalert2.js'

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
        reset() {
            axios.post('/auth/reset', { email: this.email }).then(response => {
                this.$store.commit('setAccessToken', null);
                this.$router.replace({ name: 'auth.login' });

                Swal.fire({
                    title: 'Password Reset',
                    text: 'We have emailed you a link to reset your password.',
                    type: 'success',
                })
            }).catch(error => {
                Swal.fire({
                    title: 'Login error',
                    text: 'The details you entered were not correct, please try again.',
                    type: 'error',
                })
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
