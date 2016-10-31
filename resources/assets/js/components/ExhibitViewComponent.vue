<template>
    <div class="box-header with-border">
        <h3 class="box-title">Data Details Items</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <span class="label label-primary" v-link="{ name : 'editItem', params : {id : 0}}">Create</span>
            <button class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <!--<span class="label label-default">8 New Messages</span>-->
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="col-md-12">

            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th v-for="column in field">
                        {{ column }}
                    </th>
                    <th>operate</th>
                <tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <th v-for="value in item">
                        {{ value }}
                    </th>
                    <th>
                        <button  class="btn btn-info edit" value="{{ item.id }}" v-link="{ name: 'editItem', params: { id: item.id } }">编辑</button>
                        <button class="btn btn-warning delete" value="{{ item.id }}" v-link="{ name: 'remove', params: { id : item.id}}">删除</button>
                    </th>
                </tr>
                </tbody>
            </table>

        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <!--The footer of the box-->
    </div><!-- box-footer -->
</template>
<style>
</style>
<script>
    import { mapGetters, mapActions } from 'vuex';
    export default{
        data() {
            return {
                field : [],
                items : {}
            }
        },
        ready() {
            var uri = this.$store.state.authorization.pandoraUrl;
            var destin = '/' + uri;
            this.$http.get(destin).then(function (response) {
                var retrieveBox = response.json();
                this.$set('field', retrieveBox.field);
                this.$set('items', retrieveBox.items);
            })
        }
    }
</script>