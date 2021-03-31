import Vue from 'vue'
import Vuex from 'vuex'

/**
 * Adds the promise polyfill for IE 11
 */
require('es6-promise').polyfill();

Vue.use(Vuex)

import { routePermissions } from './routePermissions.js';
import { auth } from './modules/auth.js';
import { users } from './modules/users.js';
import { adminAuth } from './modules/administrator/auth.js';
import { administrators } from './modules/administrators.js';
import { shots } from './modules/shots.js';

export default new Vuex.Store({
    modules: {
        routePermissions: routePermissions,
        auth: auth,
        users: users,
        adminAuth: adminAuth,
        administrators: administrators,
        shots: shots,
    }
})