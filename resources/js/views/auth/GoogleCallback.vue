<template>
    <b-modal :active="true">
        <header class="modal-card-head">
            <h2 class="modal-card-title">Authorising... please wait.</h2>
            <router-link class="button is-primary" :to="{ name: 'auth.register' }">Register</router-link>
            <router-link class="button is-primary" :to="{ name: 'auth.forgot' }">Forgot your password?</router-link>
        </header>
        <section class="modal-card-body">
            <p>This should only take a few seconds.</p>
        </section>
    </b-modal>
</template>

<script>

    import Swal from 'sweetalert2';

    export default {
        mounted() {

            let urlParams = _.chain(window.location.search)
                .replace('?', '')
                .split('&')
                .map(_.partial(decodeURIComponent, _))
                .map(_.partial(_.split, _, '=', 2))
                .fromPairs()
                .value();

            urlParams.device_name = 'ic_web_ui';

            axios.post('/auth/login/google', urlParams)
                .then((response) => {
                    if (response.data) {
                        this.$store.commit('setAccessToken', response.data);
                        this.$root.updateUser();
                        this.$router.replace({name: 'index'});
                    }
                })
                .catch((error) => {
                    Swal({
                        title: 'Authentication Error',
                        text: error.response.data.message,
                        icon: 'error',
                        buttons: {
                            cancel: 'OK',
                        }
                    })
                });
        }
    }
</script>
