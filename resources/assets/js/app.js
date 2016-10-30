var Vue = require('vue');
var VueRouter = require('vue-router');
var VueResource = require('vue-resource');
// import Vue from 'vue';

import  AppEntrance from './vueDocker/AppEntrance.vue';
import ExhibitView from './components/ExhibitViewComponent.vue';
import EditView from './components/EditViewComponent.vue';
import CreateView from './components/CreateViewComponent.vue';
import DeleteView from './components/DeleteViewComponent.vue';

Vue.use(VueRouter);
Vue.use(VueResource);

var router = new VueRouter();


router.map({
    '/exhibit' : {
        name : 'exhibition',
        component : ExhibitView
    },
    '/create' : {
        name : 'create',
        component: CreateView
    },
    '/edit/:id' : {
        name : 'editItem',
        component : EditView
    },
    '/delete/:id' : {
        name : 'remove',
        component : DeleteView
    }
});

router.start(AppEntrance, '#vue-content');


