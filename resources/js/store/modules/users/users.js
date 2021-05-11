import UsersAPI from '../../../api/users.js';

export const normalUsers = {
    namespaced: true,

    /**
     * Defines state being minitored for users module
     */
    state: {

    },

    /**
     * Defines actions used to retrive data
     */
    actions: {
        /**
         * Get current user
         */
        getCurrentUser({commit}) {
            return new Promise((resolve, reject) => {
                UsersAPI.getCurrentUser()
                    .then((response) => {
                        commit('users/setCurrentUser', response.data.user, { root: true });
                        resolve(response.data);
                    }).catch((error) => {
                        commit('users/setCurrentUser', null, { root: true });
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Create user
         */
        createUser({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.createUser(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Get users
         */
        getUsers({commit}, params) {
            return new Promise((resolve, reject) => {
                UsersAPI.getUsers(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    })
            })
        },

        /**
         * Get user
         */
        getUser({commit}, id) {
            return new Promise((resolve, reject) => {
                UsersAPI.getUser(id)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    })
            })
        },

        /**
         * Search users 
         */
        search({commit}, params) {
            return new Promise((resolve, reject) => {
                UsersAPI.search(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Update user
         */
        updateUser({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.updateUser(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Get Roles the user have
         */
        getRoles({commit}, userId) {
            return new Promise((resolve, reject) => {
                UsersAPI.getRoles(userId)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getPermissions({commit}, userId) {
            return new Promise((resolve, reject) => {
                UsersAPI.getPermissions(userId)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Get permissions the user have
         */
        getDirectPermissions({commit}, userId) {
            return new Promise((resolve, reject) => {
                UsersAPI.getDirectPermissions(userId)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Grant roles to user
         */
        grantRoles({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.grantRoles(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        /**
         * Cancel role from user
         */
        cancelRole({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.cancelRole(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        grantPermissions({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.grantPermissions(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

         /**
         * Cancel permission from user
         */
        cancelPermission({commit}, data) {
            return new Promise((resolve, reject) => {
                UsersAPI.cancelPermission(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },
    },

    /**
     * Defines mutations used to update state
     */
    mutations: {

    },

    /**
     * Defines getters used to retrieve state
     */
    getters: {

    }
}