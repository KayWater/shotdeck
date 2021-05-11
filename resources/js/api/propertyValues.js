import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    createPropertyValue: function(data) {
        return axios.post(CONFIG.API_URL + '/properties/'+ data.propertyId +'/values', data);
    },

    getPropertyValues: function(params) {
        return axios.get(CONFIG.API_URL + '/property-values', { params: params });
    },
    
    getPropertyValue: function(id) {
        return axios.get(CONFIG.API_URL + '/property-value/' + id);
    },

    updatePropertyValue: function(data) {
        return axios.put(CONFIG.API_URL + '/property-value/' + data.valueId, data);
    }
}