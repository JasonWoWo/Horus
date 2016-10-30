<template>
    <div>
        <div>this is template body</div>
        <div>Delete {{$route.params.id}}</div>
    </div>
</template>
<style>
    body{
        background-color:#ff0000;
    }
</style>
<script>
    export default{
        data() {
            return{
                msg:'hello vue'
            }
        },
        ready() {
            console.log(this.$route.params);
        },
        methods : {
            deleteItems : function () {
                this.$http.delete('/manager/' + this.$route.params.id, {headers : {'X-CSRF-TOKEN' : this.$get('token')}})
                        .then(function (response) {


                })
            }
        }
    }
</script>
