import PropertyValuesAPI from '../../api/propertyValues.js';

export const propertyValues = {
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
        createPropertyValue({commit}, data) {
            return new Promise((resolve, reject) => {
                PropertyValuesAPI.createPropertyValue(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getPropertyValues({commit}, params) {
            return new Promise((resolve, reject) => {
                PropertyValuesAPI.getPropertyValues(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },
        
        getPropertyValue({commit}, id) {
            return new Promise((resolve, reject) => {
                PropertyValuesAPI.getPropertyValue(id)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        updatePropertyValue({commit}, data) {
            return new Promise((resolve, reject) => {
                PropertyValuesAPI.updatePropertyValue(data)
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