<template>
    <div id="main">
        <main-menu v-if="$root.user"></main-menu>
        <div class="lower">
            <planets-menu v-if="$root.user"></planets-menu>
            <div class="content">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>

    import MainMenu from '@/templates/shared/MainMenu';
    import PlanetsMenu from '@/templates/planets/Menu';

    export default {
        components: {
            MainMenu,
            PlanetsMenu,
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
