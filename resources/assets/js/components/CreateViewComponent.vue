<template>
    <div>
        <div>Create</div>
    </div>
</template>
<style>
</style>
<script>
    export default{
        data() {
            return {
                token : '',
                items : {
                    text : [{ value : 'HENRIK', label: '昵称', property_name : 'username'},
                        { value : '15948355019', label: "手机号码", property_name : "phone"}
                    ],
                    select : [
                        { value : 12, label : '品类', property_name : 'category', options :[{text: 'cake', value: 12 }, { text: 'flower', value: 13 }, { text: 'gift', value: 14 }]},
                        { value : 110100, label : '城市', property_name : 'city', options : [{text: 'BeiJing', value: 110100 }, { text: 'ChangChun', value: 130123 }, { text: 'WuHan', value: 429000 }]}
                    ],
                    radio : [{ value : 1, label : "性别", property_name : 'sex', options : [{text: 'female', value : 1}, {text: 'male', value : 0}, {text: 'unkown', value : -1}]}],
                    checkbox :[
                        {value : [101], label : '交通工具', property_name : 'port', options : [{text: 'motobike', value : 101}, {text: 'bike', value : 103}]},
                        {value : [1101], label : '职业', property_name : 'career', options : [{text: '教师', value : 1101}, {text: '艺术家', value : 11203}]}
                    ],
                    date : [{value : '2016-10-12', label : '创建时间', property_name: 'createOn'}]
                }
            }
        },
        ready() {
//            alert(this.$route.params.resource);
            var destin = '/manager/' + 'create';
            this.$http.get(destin).then(function (response) {
                var editItems = response.text();
                alert(editItems);
                var itemObject = response.json();
                this.$set('items', itemObject.token);
            });
        }
    }
</script>
