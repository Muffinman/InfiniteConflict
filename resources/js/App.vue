<template>
    <div>
        <main-menu></main-menu>
        <div class="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

    import MainMenu from '@/templates/shared/MainMenu';

    export default {
        components: {
            MainMenu,
        },
        data() {
            return {

            }
        },
        mounted() {
            axios.get('/api/index')
                .then(function(response){
                });
        }
    }
</script>
