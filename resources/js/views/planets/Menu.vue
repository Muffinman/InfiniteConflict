<template>
    <section class="planets-menu">
        <nav>
            <div v-for="planet in planets" :key="planet.id" class="planet">
                <router-link :to="{ name: 'planets.view', params: { id: planet.id } }">
                    <img :src="planet.src" width="150">
                    <span>{{ planet.name }}</span>
                </router-link>
            </div>
        </nav>
    </section>
</template>

<script>
export default {
    data() {
        return {
            planets: [],
        }
    },
    mounted() {
        axios.get('/planets')
            .then(response => {
                this.planets = response.data.data;
                this.updatePlanetImages();
            });
    },
    methods: {
        updatePlanetImages() {
            this.planets.forEach(planet => {
                planet.src = `/images/planets/${planet.type}.jpg`;
            })
        }
    }
}
</script>
