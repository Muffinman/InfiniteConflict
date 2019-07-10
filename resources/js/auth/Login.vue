<template>

    <b-modal :active="true">
        <header class="modal-card-head">
            <p class="modal-card-title">Login</p>
        </header>
        <section class="modal-card-body">
            <b-field label="Email">
                <b-input type="email" v-model="email"></b-input>
            </b-field>

            <b-field label="Password">
                <b-input v-model="password" type="password" value="" password-reveal></b-input>
            </b-field>
        </section>
        <footer class="modal-card-foot justify-content-between">
            <button class="button" type="button">Forgot your password?</button>
            <button class="button is-primary" @click="login">Login</button>
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
            if (this.$store.state.auth.access_token) {
                this.$router.replace('/');
            }
        },
        methods: {
            login() {
                let that = this;
                axios.post('/api/login', { email: this.email, password: this.password}).then(response => {
                    that.$store.commit('setAuth', response.data);
                    that.$router.replace('/');
                })
            }
        }
    }
</script>
