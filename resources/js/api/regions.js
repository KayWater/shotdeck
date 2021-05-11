import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    getGenres: function(params) {
        return axios.get(CONFIG.API_URL + '/genres', { params: params });
    },

    getRegionsAll: function(params) {
        return axios.get(CONFIG.API_URL + '/regions/all', { params: params });
    },
}