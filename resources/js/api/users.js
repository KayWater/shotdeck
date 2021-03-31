import { CONFIG } from '../config.js';

export default {

    getCurrentUser: function() {
        return axios.get(CONFIG.API_URL + '/users/current');
    },
    
    createUser: function(data) {
        return axios.post(CONFIG.API_URL + '/users', data);
    },

    getUsers: function(params) {
        return axios.get(CONFIG.API_URL + '/users', { params: params });
    },

    getUser: function(id) {
        return axios.get(CONFIG.API_URL + '/users/' + id);
    },

    search: function(params) {
        return axios.get(CONFIG.API_URL + '/users/search', {params: params});
    },

    updateUser: function(data) {
        return axios.put(CONFIG.API_URL + '/users/' + data.id, data)
    },

    getRoles: function(userId) {
        return axios.get(CONFIG.API_URL + '/users/' + userId + '/roles');
    },

    getPermissions: function(userId) {
        return axios.get(CONFIG.API_URL + '/users/' + userId + '/permissions');
    },

    getDirectPermissions: function(userId) {
        return axios.get(CONFIG.API_URL + '/users/' + userId + '/direct-permissions');
    },

    grantRoles: function(data) {
        return axios.put(CONFIG.API_URL + '/users/' + data.userId + '/roles', {
            roles: data.roles,
        });
    },

    cancelRole: function(data) {
        return axios.delete(CONFIG.API_URL + '/users/' + data.userId + '/roles/' + data.roleId);
    },

    grantPermissions: function(data) {
        return axios.put(CONFIG.API_URL + '/users/' + data.userId + '/permissions', {
            permissions: data.permissions,
        });
    },

    cancelPermission: function(data) {
        return axios.delete(CONFIG.API_URL + '/users/' + data.userId + '/permissions/' + data.permissionId);
    },
}