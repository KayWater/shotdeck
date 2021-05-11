import { users } from './users.js';
import { administrators } from './administrators.js';

import moment from 'moment';

export const auth = {
    namespaced: true,

    /**
     * Defines the state being minitored for the module.
     */
    state: {
        accessToken: window.localStorage.getItem('access_token'),

        isAdmin: window.localStorage.getItem('is_admin'),
    },

    /**
     * Defines the actions used to retrieve data
     */
    actions: {
        
    },

    /**
     * Defines the mutations to update the state
     */
    mutations: {
        setAccessToken(state, token) {
            state.accessToken = token;
        },

        setIsAdmin(state, isAdmin) {
            state.isAdmin = isAdmin
        }
    },

    /**
     * Defines the getters to retrieve the state
     */
    getters: {
        isLogined: (state) => {
            return !!state.accessToken;
        },

        isAdmin: (state) => {
            return parseInt(state.isAdmin) === 1;
        }
    },

    modules: {
        users: users,
        administrators: administrators,
    }
}