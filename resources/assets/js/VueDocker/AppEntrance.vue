<template>
    <div>
        <!--<div>App Entrance View for Vue  </div>-->
        <router-view></router-view>
    </div>
</template>
<style>

</style>
<script>
    import store from '../store/index.js';
    export default{
        store,
        data() {
            return {
                resource: ''
            }
        },
        ready() {
            var suffix = this.pandoraBox();
            this.$store.dispatch('pandora', suffix);
            this.$router.go({name : 'exhibition'});
        },
        methods : {
            pandoraBox () {
                return window.location.pathname.split("/").pop();
            },
//            pandora (suffix) {
//                this.$store.dispatch('pandora', suffix);
//            }

        }

    }
</script>
