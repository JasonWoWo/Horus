<template>

    <div class="box-header with-border">
        <h3 class="box-title">Modify DataDetails Item</h3>
        <div class="box-tools pull-right">
            <!-- Buttons, labels, and many other things can be placed here! -->
            <!-- Here is a label for example -->
            <!--<span class="label label-primary">Label</span>-->
        </div><!-- /.box-tools -->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="col-md-12">

            <div class="form-horizontal">
                <!--<div>this is template body EnterEditView</div>-->
                <!--<div>Edit {{$route.params.id}}</div>-->
                <div v-for="item in items.text" class="form-group">
                    <div v-if="item.show" class="control-group">
                        <label class="col-sm-1 control-label">{{item.label}}</label>
                        <div class="col-sm-11 controls">
                            <input v-if="item.disable" type="text" v-model="item.value" class="form-control" disabled/>
                            <input v-else type="text" v-model="item.value" class="form-control"/>
                            <!--<input type="text" v-model="item.value" class="form-control" />{{item.value}}-->
                        </div>
                    </div>
                </div>

                <div class="form-group" v-for="item in items.date">
                    <div v-if="item.show" class="control-group">
                        <label class="col-sm-1 control-label"> {{item.label}}</label>
                        <div class="input-group date controls">
                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                            <input type="text" class="form-control pull-right" id="datepickder"/>
                            <!--<input type="text" class="form-control pull-right" v-bind:value="item.value" id="datepicker"/>-->
                        </div>
                    </div>

                </div>

                <div v-for="item in items.select" class="form-group">
                    <div v-if ="item.show" class="control-group">
                        <label class="col-sm-1 control-label">{{item.label}}</label>
                        <div class="col-sm-8 controls">
                            <select v-model="item.value" class="form-control " >
                                <option v-for="option in item.options" v-bind:value="option.value">
                                    {{ option.text }}
                                </option>
                            </select>
                        </div>
                    </div>


                </div>

                <div v-for="item in items.radio" class="form-inline">
                    <div v-if="item.show">
                        <label class="col-sm-1 control-label">{{item.label}}</label>
                        <!--<div class="radio">-->
                            <!--<label v-for="option in item.options" class="radio-inline">-->
                                <!--<input type="radio" v-bind:value="option.value" v-model="item.value"/>&nbsp; {{option.text}} &nbsp;&nbsp;-->
                            <!--</label>-->
                        <!--</div>-->
                        <div v-for="option in item.options" class="radio controls">
                            <label>
                                <!--<input type="radio" value="{{option.value}}" v-model="item.value"/>&nbsp; {{option.text}} &nbsp;&nbsp;-->
                                <input type="radio" v-bind:value="option.value" v-model="item.value"/>&nbsp;&nbsp;&nbsp; {{option.text}} &nbsp;&nbsp;&nbsp;
                            </label>
                        </div>
                    </div>

                    <!--<pre>{{item.value}}</pre>-->
                </div>

                <div v-for="item in items.checkbox" class="form-inline">
                    <div v-if="item.show" class="control-group">
                        <label class="col-sm-1 control-label">{{item.label}}</label>
                        <div v-for="checkItem in item.options" class="checkbox controls">
                            <label>
                                <input type="checkbox" v-bind:value="checkItem.value" v-model="item.value"/>&nbsp; {{checkItem.text}} &nbsp;&nbsp;
                            </label>
                        </div>
                        <!--<pre>{{item.value | json}}</pre>-->
                    </div>
                    <!--<pre>{{item.value | json}}</pre>-->
                </div>
            </div>
        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <button v-if="isEdit" v-on:click="editPost" class="btn btn-primary btn-block" type="submit">Submit</button>
        <button v-else v-on:click="createPost" class="btn btn-primary btn-block">Submit</button>
        <button v-link="{ name: 'exhibition'}" class="btn btn-default btn-block">Cancel</button>
    </div><!-- box-footer -->

</template>
<style>
    body{
        background-color:#ff0000;
    }
</style>
<script>

    export default{
        data() {
            return {
                token : '',
                isEdit : false,
                items : {}
            }
        },
        ready() {
            var destination = '/' + this.$store.state.authorization.pandoraUrl + '/';
            if (parseInt(this.$route.params.id)) {
                destination = destination + this.$route.params.id + '/edit';
                this.$set('isEdit', true);
            } else {
                destination = destination  + 'create';
            }
            this.$http.get(destination).then(function (response) {
                var editItems = response.text();
                console.log(editItems);
                var itemObject = response.json();
                this.$set('token', itemObject.token);
                this.$set('items', itemObject.items);
            });
        },
        methods : {
            editPost : function () {
                var targetUrl = '/' + this.$store.state.authorization.pandoraUrl + '/' + this.$route.params.id;
                var targetPostParams = this.buildQueryParams(this.$get('items'));
                console.log(targetPostParams);
                console.log(this.$get('token'));
                this.$http.put(targetUrl, targetPostParams, {headers : {'X-CSRF-TOKEN' : this.$get('token')}}).then(function (response) {
                    var responseObj = response.json();
                    if (responseObj.success) {
                        this.$router.go({name : 'exhibition', query : {resource : 'manager'}})
                    }
                })
            },
            createPost : function () {
                var targetUrl = '/' + this.$store.state.authorization.pandoraUrl + '?brand.id=1';
                var targetPostParams = this.buildQueryParams(this.$get('items'));
                this.$http.post(targetUrl, targetPostParams, {headers : {'X-CSRF-TOKEN' : this.$get('token')}}).then(function (response) {
                    var responseObj = response.json();
                    if (responseObj.success) {
                        this.$router.go({name : 'exhibition'})
                    }
                })
            },
            buildQueryParams : function (items) {
                var queryParams = {};
                if (items.text) {
                    queryParams = this.buildMappingValue(items.text, queryParams);
                }
                if (items.select) {
                    queryParams = this.buildMappingValue(items.select, queryParams);
                }
                if (items.checkbox) {
                    queryParams = this.buildMappingValue(items.checkbox, queryParams);
                }
                if (items.radio) {
                    queryParams = this.buildMappingValue(items.radio, queryParams);
                }
                if (items.date) {
                    queryParams = this.buildMappingValue(items.date, queryParams);
                }
                return queryParams;
            },
            buildMappingValue : function (item, targetParam) {
                item.forEach(function (originItemObj) {
                    targetParam[originItemObj.property_name] = originItemObj.value;
                });
                return targetParam;
            }
        }

    }
</script>
