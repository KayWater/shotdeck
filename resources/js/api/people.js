import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    createPeople: function(data) {
        return axios.post(CONFIG.API_URL + '/people/create', data);
    },

    searchPeople: function(params) {
        return axios.get(CONFIG.API_URL + '/people/search', { params: params });
    }
}