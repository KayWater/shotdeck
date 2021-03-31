import { CONFIG } from '../config.js';

export default {
    createShot: function(data) {
        return axios.post(CONFIG.API_URL + '/shots', data);
    },

    getShots: function(params) {
        return axios.get(CONFIG.API_URL + '/shots', { params: params });
    }
}