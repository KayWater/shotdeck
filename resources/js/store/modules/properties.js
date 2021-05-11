import PropertiesAPI from '../../api/properties.js';

export const properties = {
    namespaced: true,

    /**
     * Defines the state being minitored for the module.
     */
    state: {
       
    },

    /**
     * Defines the actions used to retrieve data
     */
    actions: {
        createProperty({commit}, data) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.createProperty(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        queryProperties({commit}, params) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.queryProperties(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getProperties({commit}, params) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.getProperties(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getProperty({commit}, id) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.getProperty(id)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        updateProperty({commit}, data) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.updateProperty(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getPropertyValuesByProperty({commit}, id) {
            return new Promise((resolve, reject) => {
                PropertiesAPI.getPropertyValuesByProperty(id)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        }
    },

    /**
     * Defines the mutations to update the state
     */
    mutations: {
       
    },

    /**
     * Defines the getters to retrieve the state
     */
    getters: {

    }
}