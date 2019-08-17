<template>
    <b-modal :active="true">
        <header class="modal-card-head">
            <p class="modal-card-title">Login</p>
            <button class="button is-primary pull-right" @click="loginWithGoogle">Login With Google</button>
        </header>
        <section class="modal-card-body">
            <b-field label="Email">
                <b-input type="email" v-model="email"></b-input>
            </b-field>

            <b-field label="Password">
                <b-input v-model="password" type="password" value="" password-reveal></b-input>
            </b-field>

            <button class="button is-primary pull-right" @click="login">Login</button>
        </section>
        <footer class="modal-card-foot">
            <button class="button" type="button">Register</button>
            <button class="button" type="button">Forgot your password?</button>
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
            if (this.$store.getters.getAuth.access_token) {
                this.$router.replace('/');
            }
        },
        methods: {
            login() {
                axios.post('/auth/login/password', { email: this.email, password: this.password}).then(response => {
                    this.$store.commit('setAuth', response.data);
                    this.$root.updateUser();
                    this.$router.replace('/');
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
