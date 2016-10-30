/**
 * Created by wangxionghao on 2016/10/22.
 */

export const getName = state => state.authorization.name;
export const getToken = state => state.authorization.token;
export const getAuth = state => state.authorization.authenticated;
export const getValidateError = state => state.authorization.validate_errors;
export const getPandoraUrl = state => state.authorization.pandoraUrl;