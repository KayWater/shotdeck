<template>
    <app-layout>
        <template v-slot:header>
            <navigation></navigation>
        </template>
        <div class="container mt-4">
            <div v-if="loading" class="text-center">
                Loading...
            </div>
            <div v-if="movie" class="movie-container">
                <h2 class="text-2xl ">{{ movie.name }} <router-link class="ml-2 small" :to="'/movies/'+movie.id+'/edit'"><i class="el-icon-edit"></i></router-link></h2>
                <div class="flex mt-2">
                    <div class="w-1/6">
                        <img :src="'storage/'+ movie.poster_url">
                    </div>
                    <ul class="ml-4">
                        <li>
                            <span>导演：</span>
                            <template v-for="director in directors">
                                <span :key="director.id">
                                    {{director.name}}
                                </span>
                            </template>
                        </li>
                        <li>
                            <span>主演：</span>
                            <template v-for="actor in actors">
                                <span :key="actor.id">
                                    {{actor.name}}
                                </span>
                            </template>
                        </li>
                        <li>
                            <span>类型：</span>
                            <template v-for="genre in movie.genres">
                                <span :key="genre.id">
                                    {{genre.name}}
                                </span>
                            </template>
                        </li>
                        <li>
                            <span>地区：</span>
                            <template v-for="region in movie.regions">
                                <span :key="region.id">
                                    {{region.name}}
                                </span>
                            </template>
                        </li>
                        <li>
                            <span>上映时间：</span>
                            <span>
                                {{ movie.release_time }}
                            </span>
                        </li>
                        <li>
                            <span>时长：</span>
                            <span>
                                {{ movie.duration }}分钟
                            </span>
                        </li>
                        <li>
                            <span>镜头数：</span>
                            <span>
                                {{ movie.shot_count }}
                                <router-link class="ml-2 small text-blue-600" :to="'/search/?movieId=' + movie.id">所有镜头</router-link>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="mt-4">
                    <p class="text-xl">{{ movie.name}}剧情简介</p>
                    <p class="intro">{{ movie.intro }}</p>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../layout/AppLayout.vue';
import Navigation from '../../layout/Navigation.vue';

import { mapActions } from 'vuex';
export default {
    components: {
        AppLayout,
        Navigation
    },

    props: {
        id: {
            type: [ String, Number ],
            required: true,
        }
    },

    data() {
        return {
            movie: null,
            loading: false,
        }
    },

    computed: {
        directors: function() {
            if (!this.movie) {
                return [];
            }
            let people = this.movie.hasOwnProperty('people') ? this.movie.people : [];
            let directors = people.filter((item) => {
                return item.pivot.role_type == '0';
            });
            return directors;
        },

        actors: function() {
            if (!this.movie) {
                return [];
            }
            let people = this.movie.hasOwnProperty('people') ? this.movie.people : [];
            return people.filter((item) => {
                return item.pivot.role_type == '1';
            });
        }
    },

    methods: {
        ...mapActions('movies', [
            'getMovie'
        ]),

        handleGetMovie(id) {
            this.loading = true;
            this.getMovie(id).then((response) => {
                this.loading = false;
                this.movie = response.movie;
            }).catch((error) => {
                console.log(error);
            })
        }
    },

    created() {
        this.handleGetMovie(this.id);
    },

    beforeRouteUpdate(to, from, next) {
    }
}
</script>

<style scoped>
.filter {
    @apply flex;
    @apply flex-wrap;
}

.filter .filter-item {
    @apply mx-2;
    @apply px-2;
    @apply py-1;
    cursor: pointer;
}

.filter .filter-item.active {
    @apply bg-blue-300;
}

.intro {
    text-indent: 2rem;
}
</style>