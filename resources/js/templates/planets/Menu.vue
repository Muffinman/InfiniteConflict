<template>
    <section class="planets-menu">
        <nav>
            <div v-for="planet in planets" :key="planet.id" class="planet">
                <router-link to="/">
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
            planets: [
                {
                    name: 'Muffins',
                    id: 1,
                    src: '/images/planets/1.jpg',
                }
            ],
        }
    },
    mounted() {
        for (let i=2; i<=25; i++) {
            this.planets.push({
                name: `Planet ${i}`,
                id: i,
                src: `/images/planets/${i}.jpg`,
            });
        }
    }
}
</script>
