/**
 * Created by wangxionghao on 2016/10/22.
 */

// import Vue from 'vue';
// import Vuex from 'vuex';
var Vue = require('vue');
var Vuex = require('vuex');
import * as actions from './actions';
import * as getters from './getters';
import authorization from './modules/authorization';

Vue.use(Vuex);

export default new Vuex.Store({
    actions,
    getters,
    modules : {
        authorization
    }
});