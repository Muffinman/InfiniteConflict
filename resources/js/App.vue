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

    import MainMenu from '@/views/shared/MainMenu';
    import PlanetsMenu from '@/views/shared/PlanetsMenu';

    export default {
        components: {
            MainMenu,
            PlanetsMenu,
        },
        mounted() {
            this.getIndex()
            this.getPlanets()
        },
        methods: {
            getIndex() {
                window.axios.get('/index')
                    .then(response => {
                    });
            },
            getPlanets() {
                axios.get('/planets')
                    .then(response => {
                        this.$store.commit('setPlanets', response.data.data);
                    });
            }
        }
    }
</script>
