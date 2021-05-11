<template>
    <app-layout>
        <template v-slot:header>
            <navigation></navigation>
        </template>
        <div class="header container mt-2">
            <ul class="filter my-2">
                <li class="filter-item" 
                    v-bind:class="{ 'active': genreFilterDefaultActive === 0 }"
                    @click="handleGenreFilterChange()">
                    <a>全部类型</a>
                </li>
                <template v-for="(filter, index) in genreFilters">
                    <li :key="filter.id" 
                        class="filter-item"
                        :index="index + 1"
                        v-bind:class="{ 'active': genreFilterDefaultActive === index + 1 }"
                        @click="handleGenreFilterChange(filter.id, index)">
                        <a>{{filter.name}}</a>
                    </li>
                </template>
            </ul>
            <ul class="filter my-2">
                <li class="filter-item" 
                    v-bind:class="{ 'active': regionFilterDefaultActive === 0 }"
                    @click="handleRegionFilterChange()">
                    <a>全部地区</a>
                </li>
                <template v-for="(filter, index) in regionFilters">
                    <li :key="filter.id" 
                        class="filter-item"
                        :index="index + 1"
                        v-bind:class="{ 'active': regionFilterDefaultActive === index + 1 }"
                        @click="handleRegionFilterChange(filter.id, index)">
                        <a>{{filter.name}}</a>
                    </li>
                </template>
            </ul>
            <ul class="filter my-2">
                <li class="filter-item" 
                    v-bind:class="{ 'active': yearFilterDefaultActive === 0 }"
                    @click="handleYearFilterChange()">
                    <a>全部年代</a>
                </li>
                <template v-for="(filter, index) in yearFilters">
                    <li :key="filter.key" 
                        class="filter-item"
                        :index="index + 1"
                        v-bind:class="{ 'active': yearFilterDefaultActive === index + 1 }"
                        @click="handleYearFilterChange(filter.value, index)">
                        <a>{{filter.label}}</a>
                    </li>
                </template>
            </ul>
        </div>
        <div class="container mt-4">
            <div class="movie-container ">
                <template v-for="movie in movies">
                    <div :key="movie.id" class="inline-block w-1/6  my-1">
                        <router-link :to="{ path: '/movies/' + movie.id }">
                            <img :src="'storage/' + movie.poster_url" style="width: 180px; height: 268px">
                        </router-link>
                        <router-link :to="{ path: '/movies/' + movie.id }">
                            <span>{{ movie.name }}</span>
                        </router-link>
                    </div>
                </template>
            </div>
        </div>
        <my-infinite-scroll @loadMore="loadMore" :no-more.sync="noMore"></my-infinite-scroll>
    </app-layout>
</template>

<script>
import AppLayout from '../../layout/AppLayout.vue';
import Navigation from '../../layout/Navigation.vue';
import MyInfiniteScroll from '../../global/MyInfiniteScroll.vue';
import { mapActions } from 'vuex';
export default {
    components: {
        AppLayout,
        MyInfiniteScroll,
        Navigation
    },
    data() {
        return {
            genreFilters: [],
            genreFilterDefaultActive: 0,

            regionFilters: [],
            regionFilterDefaultActive: 0,

            yearFilters: [
                {
                    key: '2021',
                    label: '2021',
                    value: '2021',
                },
                {
                    key: '2020',
                    label: '2020',
                    value: '2020',
                },
                {
                    key: '2019',
                    label: '2019',
                    value: '2019',
                },
                {
                    key: '2018',
                    label: '2018',
                    value: '2018',
                },
                {
                    key: '2017',
                    label: '2017',
                    value: '2017'
                },
                {
                    key: '2010',
                    label: '2010-2016',
                    value: '2010-2016',
                },
                {
                    key: '2000',
                    label: '2000-2009',
                    value: '2000-2009'
                },
                {
                    key: '1990',
                    label: '90年代',
                    value: '1990-1999'
                },
                {
                    key: '1980',
                    label: '80年代',
                    value: '1980-1989'
                },
                {
                    key: '1970',
                    label: '70年代',
                    value: '1970-1979'
                },
                {
                    key: '1960',
                    label: '60年代',
                    value: '1960-1969'
                },
                {
                    key: '1950',
                    label: '更早',
                    value: '0-1959'
                }
            ],
            yearFilterDefaultActive: 0,

            movies: [],
            limit: 20,
            offset: 0,

            noMore: false,
        }
    },

    methods: {
        ...mapActions('genres', [
            'getGenresAll'
        ]),

        ...mapActions('regions', [
            'getRegionsAll'
        ]),

        ...mapActions('movies', [
            'getMovies'
        ]),

        loadMore() {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { 
                limit: this.limit,
                offset: this.offset
            });
            this.getMovies( query )
                .then((response) => {
                    if (response.movies.length === 0) {
                        this.noMore = true;
                    }
                    this.movies = this.movies.concat(response.movies);
                    this.offset += response.movies.length;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
        },

        handleGenreFilterChange(id=0, index=-1) {
            this.genreFilterDefaultActive = index + 1;
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { genre: id });

            this.$router.replace({ path: this.$route.path, query: query });
        },

        handleRegionFilterChange(id=0, index=-1) {
            this.regionFilterDefaultActive = index + 1;
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { region: id });

            this.$router.replace({ path: this.$route.path, query: query });
        },

        handleYearFilterChange(value='', index=-1) {
            this.yearFilterDefaultActive = index + 1;
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { year: value });

            this.$router.replace({ path: this.$route.path, query: query });
        },

         // 初始化过滤器
        initFilters(params) {
            if (params.hasOwnProperty('genre')) {
                this.genreFilterDefaultActive = this.genreFilters.findIndex((item) => item.id == params.genre) + 1;
            }

            if (params.hasOwnProperty('region')) {
                this.regionFilterDefaultActive = this.regionFilters.findIndex((item) => item.id == params.region) + 1;
            }

            if (params.hasOwnProperty('year')) {
                this.yearFilterDefaultActive = this.yearFilters.findIndex((item) => item.value == params.year ) + 1;
            }
        },
    },

    created() {
        
        this.getGenresAll().then((response) => {
            this.genreFilters = response.genres;
            this.initFilters(this.$route.query);
        });

        this.getRegionsAll().then((response) => {
            this.regionFilters = response.regions;
            this.initFilters(this.$route.query);
        });

        let params = this.$route.query;

        this.getMovies(params).then((response) => {
            this.movies = response.movies;
            this.offset += response.movies.length;
        });

    },

    beforeRouteUpdate(to, from, next) {
        let params = to.query;
        this.initFilters(params);
        delete params.limit;
        delete params.offset;
        this.getMovies( params ).then((response) => {
            this.movies = response.movies;
            next();
        }).catch((error) => {
            console.log(error);
        });
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
</style>