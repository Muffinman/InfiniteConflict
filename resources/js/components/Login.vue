<template>
    <div>
        <h1>Login</h1>
        <div>
            <p><input type="email" v-model="email"></p>
            <p><input type="password" v-model="password"></p>
            <p><input type="button" value="Login" @click="login"></p>
        </div>
    </div>
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