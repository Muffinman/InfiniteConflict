<template>
    <div>
        <h1>{{ planet.name }}</h1>
        {{ planet }}
    </div>
</template>

<script>
export default {
    data() {
        return {
            id: this.$route.params.id,
            planet: {
                name: 'test',
            }
        }
    },
    mounted() {
        this.getPlanet();
    },
    methods: {
        getPlanet() {
            window.axios.get(`/planets/${this.id}`)
                .then(response => {
                    this.planet = response.data.data;
                });
        }
    }
}
</script>
