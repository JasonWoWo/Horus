/**
 * Created by wangxionghao on 2016/10/22.
 */

import * as type from '../mutation-types';
// initial status
const state = {
    name : '',
    token : '',
    authenticated: false,
    pandoraUrl : '',
    validate_errors: {}
};

// mutations
const mutations = {
    [type.LOGIN] : (state, name, token) => {
        state.name = name;
        state.token = token;
        state.authenticated = true;
        localStorage.setItem('jwt-token', token);
    },
    [type.LOGOUT] : (state) => {
        state.name = '';
        state.token = '';
        state.authenticated = false;
        localStorage.removeItem('jwt-token');
    },
    [type.VALIDATE_ERROR] : (state, errors) => {
        state.validate_errors = errors;
    },
    [type.PANDORA_SETTER] : (state, pandoraUrl) => {
        state.pandoraUrl = pandoraUrl;
    }
};

export default {
    state,
    mutations
}