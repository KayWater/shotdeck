import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    getGenres: function(params) {
        return axios.get(CONFIG.API_URL + '/genres', { params: params });
    },

    getCountriesAll: function(params) {
        return axios.get(CONFIG.API_URL + '/countries/all', { params: params });
    },
}