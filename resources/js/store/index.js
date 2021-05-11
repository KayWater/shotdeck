import Vue from 'vue'
import Vuex from 'vuex'

/**
 * Adds the promise polyfill for IE 11
 */
require('es6-promise').polyfill();

Vue.use(Vuex)

import { routePermissions } from './routePermissions.js';
import { auth } from './modules/auth/index.js';
import { users } from './modules/users/index';
import { administrators } from './modules/administrator/index.js';
import { shots } from './modules/shots.js';
import { properties } from './modules/properties.js';
import { propertyValues } from './modules/propertyValues.js';
import { genres } from './modules/genres.js';
import { regions } from './modules/regions.js';
import { people } from './modules/people.js';
import { countries } from './modules/countries.js';
import { movies } from './modules/movies.js';

export default new Vuex.Store({
    modules: {
        routePermissions: routePermissions,
        auth: auth,
        users: users,
        administrators: administrators,
        shots: shots,
        properties: properties,
        propertyValues: propertyValues,
        genres: genres,
        regions: regions,
        people: people,
        countries: countries,
        movies: movies
    }
})