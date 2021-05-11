import axios from 'axios';
import { CONFIG } from '../config.js';

export default {
    createMovie: function(data) {
        return axios.post(CONFIG.API_URL + '/movies', data);
    },

    getMovies: function(params) {
        return axios.get(CONFIG.API_URL + '/movies', { params: params });
    },
    
    getMovie: function(id) {
        return axios.get(CONFIG.API_URL + '/movies/' + id);
    },

    updateMovie: function(data) {
        return axios.put(CONFIG.API_URL + '/movies/' + data.id, data);
    },

    getMovieActors: function(id) {
        return axios.get(CONFIG.API_URL + '/movies/' + id + '/actors');
    }
}