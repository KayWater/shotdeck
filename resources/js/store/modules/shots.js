import ShotAPI from '../../api/shot.js';

export const shots = {
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
       /**
         * Create shot
         */
        createShot({commit}, data) {
            return new Promise((resolve, reject) => {
                ShotAPI.createShot(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getShots({commit}, params) {
            return new Promise((resolve, reject) => {
                ShotAPI.getShots(params)
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