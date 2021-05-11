import PeopleApi from '../../api/people.js';

export const people = {
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
        createPeople({commit}, data) {
            return new Promise((resolve, reject) => {
                PeopleApi.createPeople(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        searchPeople({commit}, params) {
            return new Promise((resolve, reject) => {
                PeopleApi.searchPeople(params)
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