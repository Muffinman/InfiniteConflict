<template>
    <div>
        <h1>Authorising... please wait.</h1>
    </div>
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

            axios.post('/auth/login/google', urlParams)
                .then((response) => {
                    if (response.data) {
                        this.$store.commit('setAuth', response.data);
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
