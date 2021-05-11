import AuthAPI from '../../../api/administrator/auth.js';
import moment from 'moment';

export const administrators = {
    
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
                        window.localStorage.setItem('is_admin' , '1');
                        window.axios.defaults.headers.common['Authorization'] = data.token_type + " " + data.access_token;

                        commit('auth/setAccessToken', data.access_token, { root: true });
                        commit('auth/setIsAdmin', '1', { root: true });

                        resolve(response.data);
                    }).catch((error) => {
                        commit('auth/setAccessToken', null, { root: true });
                        commit('auth/setIsAdmin', null, { root: true });
                        reject(error.response.data);
                        console.log(error);
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

                        commit('auth/setAccessToken', null, { root: true });
                        commit('auth/setIsAdmin', null, { root: true });

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
                        window.localStorage.setItem('access_token', data.access_token);
                        window.localStorage.setItem('expired_at', moment().add(data.expires_in, 's').unix());
                        window.localStorage.setItem('refresh_token', data.refresh_token);
                        window.localStorage.setItem('token_type', data.token_type);
                        window.localStorage.setItem('is_admin' , 1);
                        window.axios.defaults.headers.common['Authorization'] = data.token_type + " " + data.access_token;

                        commit('auth/setAccessToken', data.access_token, { root: true });
                        commit('auth/setIsAdmin', '1', { root: true });

                        resolve(response.data);
                    }).catch((error) => {
                        window.localStorage.removeItem('access_token');
                        window.localStorage.removeItem('expired_at');
                        window.localStorage.removeItem('refresh_token');
                        window.localStorage.removeItem('token_type');
                        window.localStorage.removeItem('is_admin');
                        commit('auth/setAccessToken', null, { root: true });
                        commit('auth/setIsAdmin', null, { root: true });
                        reject(error.response.data);
                    })
            })
        }
    },

    /**
     * Defines the mutations to update the state
     */
    mutations: {
        /**
         * Set accessToken
         */
        setAccessToken(state, token) {
            state.accessToken = token;
        }
    },

    /**
     * Defines the getters to retrieve the state
     */
    getters: {
        
    }
}