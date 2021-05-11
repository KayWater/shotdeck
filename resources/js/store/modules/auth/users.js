import AuthAPI from '../../../api/auth.js';
import moment from 'moment';

export const users = {
    
    namespaced: true,

    /**
     * Defines the state being minitored for the module.
     */
    state: {

    },

    /**
     * Defines the actions used to retrieve data
     */
    actions: {
        /**
         * Login action
         */
        login({commit}, data) {
            return new Promise((resolve, reject) => {
                AuthAPI.login(data)
                    .then((response) => {
                        let data = response.data;
                        window.localStorage.setItem('access_token', data.access_token);
                        window.localStorage.setItem('expired_at', moment().add(data.expires_in, 's').unix());
                        window.localStorage.setItem('refresh_token', data.refresh_token);
                        window.localStorage.setItem('token_type', data.token_type);
                        window.localStorage.setItem('is_admin', 0);
                        window.axios.defaults.headers.common['Authorization'] = data.token_type + " " + data.access_token;

                        // commit('setAccessToken', data.access_token);
                        // 从全局命名空间提交父模块的mutation
                        commit('auth/setAccessToken', data.access_token, { root: true });
                        commit('auth/setIsAdmin', 0, { root: true });

                        resolve(response.data);
                    }).catch((error) => {
                        console.log(error);
                        reject(error.response.data);
                        
                    });
            });
        },

        /**
         * logout action
         */
        logout({commit}) {
            return new Promise((resolve, reject) => {
                AuthAPI.logout()
                    .then((response) => {
                        window.localStorage.removeItem('access_token');
                        window.localStorage.removeItem('expired_at');
                        window.localStorage.removeItem('refresh_token');
                        window.localStorage.removeItem('token_type');
                        window.localStorage.removeItem('is_admin');
                        commit('setAccessToken', null);
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        refreshToken({commit}, refreshToken) {
            return new Promise((resolve, reject) => {
                AuthAPI.refreshToken(refreshToken)
                    .then((response) => {
                        let data = response.data;
                        commit('setAccessToken', data.access_token);
                        window.localStorage.setItem('access_token', data.access_token);
                        window.localStorage.setItem('expired_at', moment().add(data.expires_in, 's').unix());
                        window.localStorage.setItem('refresh_token', data.refresh_token);
                        window.localStorage.setItem('token_type', data.token_type);
                        window.localStorage.setItem('is_admin' , 0);
                        window.axios.defaults.headers.common['Authorization'] = data.token_type + " " + data.access_token;
                        resolve(response.data);
                    }).catch((error) => {
                        window.localStorage.removeItem('access_token');
                        window.localStorage.removeItem('expired_at');
                        window.localStorage.removeItem('refresh_token');
                        window.localStorage.removeItem('token_type');
                        window.localStorage.removeItem('is_admin');
                        commit('setAccessToken', null);
                        reject(error.response.data);
                    })
            })
        }
    },

    /**
     * Defines the mutations to update the state
     */
    mutations: {

    },

    /**
     * Defines the getters to retrieve the state
     */
    getters: {
        
    }
}