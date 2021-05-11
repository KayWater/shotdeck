import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    createProperty: function(data) {
        return axios.post(CONFIG.API_URL + '/properties', data);
    },

    getProperties: function(params) {
        return axios.get(CONFIG.API_URL + '/properties', { params: params });
    },

    queryProperties: function(params) {
        return axios.get(CONFIG.API_URL + '/properties/query', { params: params });
    },

    getProperty: function(id) {
        return axios.get(CONFIG.API_URL + '/properties/' + id);
    },

    updateProperty: function(data) {
        return axios.put(CONFIG.API_URL + '/properties/' + data.id, data);
    },

    getPropertyValuesByProperty: function(id) {
        return axios.get(CONFIG.API_URL + '/properties/' + id + '/values')
    }
}