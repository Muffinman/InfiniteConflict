<template>

</template>

<script>
    export default {
        mounted() {
            this.$store.commit('removeUser');
            this.$store.commit('removeAccessToken');
            this.$router.replace({ name: 'auth.login' });
        }
    }
</script>
