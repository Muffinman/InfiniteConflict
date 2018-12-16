<template>
    <div>
        <h1>Login</h1>
        <div>
            <p><input type="email" v-bind="email"></p>
            <p><input type="password" v-bind="password"></p>
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
        },
        methods: {
            login() {
                let that = this;
                axios.post('/api/login', { email: this.email, password: this.password}).then(response => {
                    console.log(response.data);
                    that.store.auth.set(response.data.token);
                })
            }
        }
    }
</script>