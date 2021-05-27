<template>
    <section class="planets-menu">
        <nav>
            <div v-for="planet in planets" :key="planet.id" class="planet">
                <router-link :to="{ name: 'planets.view', params: { id: planet.id } }">
                    <img :src="'/images/planets/' + planet.type + '.jpg'" width="150">
                    <span>{{ planet.name }}</span>
                </router-link>
            </div>
        </nav>
    </section>
</template>

<script>
export default {
    computed: {
        planets() {
            return this.$store.state.planets
        },
    },
}
</script>
