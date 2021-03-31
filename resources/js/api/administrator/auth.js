import { CONFIG } from '../../config.js';

export default {
    /**
     * Login
     */
    login: function(data) {
        return axios.post(CONFIG.API_URL + '/administrator/auth/login', data);
    },

    /**
     * Post     /api/v1/auth/logout
     */
    logout: function() {
        return axios.post(CONFIG.API_URL + '/auth/logout');
    },

    refreshToken: function(refreshToken) {
        return axios.post(CONFIG.API_URL + '/auth/refresh-token', {
            refreshToken: refreshToken,
        });
    }
}