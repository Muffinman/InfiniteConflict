<template>
    <div>
        {{ welcome }}
    </div>
</template>

<script>
    export default {
        data() {
          return {
              welcome: '',
          }
        },
        mounted() {
            let that = this;
            axios.get('/api/index').then(function(response){
                that.welcome = response.data;
            });
        }
    }
</script>