import { normalUsers } from './users.js';
import { administrators } from './administrators.js';

import moment from 'moment';

export const users = {
    namespaced: true,

    /**
     * Defines the state being minitored for the module.
     */
    state: {
        /**
         * Current user
         */
         currentUser: null,
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
        /**
         * Set current user
         */
         setCurrentUser(state, user) {
            state.currentUser = user;
        },
    },

    /**
     * Defines the getters to retrieve the state
     */
    getters: {
        roles (state) {
            if (state.currentUser && !state.currentUser.hasOwnProperty('roles')) {
                return ['guest'];
            }
            return state.currentUser ? state.currentUser.roles.map(role => { return role.name }) : [];
            // return  state.currentUser.roles.map(role => { return role.name });
        },

        hasRole: (state) => (name) => {
            return !!state.currentUser.roles.find((role) => role.name == name);
        },
    },

    modules: {
        normalUsers: normalUsers,
        administrators: administrators,
    }
}