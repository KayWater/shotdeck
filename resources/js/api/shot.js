import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    createShot: function(data) {
        return axios.post(CONFIG.API_URL + '/shots', data);
    },

    getShots: function(params) {
        return axios.get(CONFIG.API_URL + '/shots', { params: params });
    },

    deleteShot: function(id) {
        return axios.delete(CONFIG.API_URL + '/shots/' + id);
    },

    getShot: function(id) {
        return axios.get(CONFIG.API_URL + '/shots/' + id);
    },

    updateShot: function(data) {
        return axios.put(CONFIG.API_URL + '/shots/' + data.id, data);
    },
}