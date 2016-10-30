/**
 * Created by wangxionghao on 2016/10/22.
 */

import * as type from './mutation-types';

// export const me = ({commit}, name, token) => { commit(type.LOGIN, name, token) };

export const pandora = ({commit, state}, uri) => {
    if (uri) {
        commit('PANDORA_SETTER', uri);
    }
};

// export const list = (type) => {alert(type.PANDORA_SETTER)};