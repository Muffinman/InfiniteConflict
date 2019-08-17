<template>

</template>

<script>
    export default {
        mounted() {
            this.$store.commit('removeUser');
            this.$store.commit('removeAuth');
            this.$router.replace({ name: 'auth.login' });
        }
    }
</script>
