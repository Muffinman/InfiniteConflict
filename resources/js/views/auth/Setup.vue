<template>
    <b-modal :active="true">
        <header class="modal-card-head">
            <p class="modal-card-title">Empire Setup</p>
        </header>
        <section class="modal-card-body">
            <b-field label="Ruler name">
                <b-input type="ruler_name" v-model="ruler_name"></b-input>
            </b-field>

            <b-field label="Home planet name">
                <b-input type="home_planet_name" v-model="home_planet_name"></b-input>
            </b-field>

            <button class="button is-primary pull-right" @click="save">Continue</button>
        </section>
    </b-modal>
</template>

<script>
    export default {
        data() {
            return {
                home_planet_name: '',
                ruler_name: '',
            }
        },
        mounted() {
            if (this.$store.getters.getUser.planet_count > 0) {
                this.$router.replace({ name: 'index' });
            }
        },
        methods: {
            save() {
                axios.post('/auth/setup', { home_planet_name: this.home_planet_name, ruler_name: this.ruler_name}).then(response => {
                    this.$router.replace({ name: 'index' });
                })
            }
        }
    }
</script>
