import MoviesApi from '../../api/movies.js';

export const movies = {
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
        createMovie({commit}, data) {
            return new Promise((resolve, reject) => {
                MoviesApi.createMovie(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getMovies({commit}, params) {
            return new Promise((resolve, reject) => {
                MoviesApi.getMovies(params)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getMovie({commit}, id) {
            return new Promise((resolve, reject) => {
                MoviesApi.getMovie(id)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        updateMovie({commit}, data) {
            return new Promise((resolve, reject) => {
                MoviesApi.updateMovie(data)
                    .then((response) => {
                        resolve(response.data);
                    }).catch((error) => {
                        reject(error.response.data);
                    });
            });
        },

        getMovieActors({commit}, id) {
            return new Promise((resolve, reject) => {
                MoviesApi.getMovieActors(id)
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