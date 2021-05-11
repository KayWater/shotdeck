<template>
    <app-layout>
        <div class="container-fluid mt-10 flex ">
            <div class="w-2/12 mr-4 fixed h-full ">
                <el-input placeholder="请输入内容" v-model="keyword">
                    <el-button slot="append" @click="handleSearch">搜索</el-button>
                </el-input>
                <div class="">
                    <el-tag v-if="movie" closable @close="handleCloseMovie(movie)">{{ movie.name }}</el-tag>
                </div>
                <el-collapse v-model="activeNames" class="filter-container overflow-auto">
                    
                    <el-collapse-item title="影片类型" name='1'>
                        <el-checkbox-group v-model="genre" @change="handleGenreChange">
                            <el-checkbox v-for="item in genreOptions" :key="item.id" :label="item.id + ''">
                                {{ item.name }}
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    
                    <template v-if="rolesAndGenderAttribute">
                        <el-collapse-item title="角色性别" name='2'>
                            <el-checkbox-group v-model="filters[rolesAndGenderAttribute.id]" @change="handleRolesAndGenderChange">
                                <el-checkbox v-for="item in rolesAndGenderAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="colorAttribute">
                        <el-collapse-item title="色彩" name='3'>
                            <el-checkbox-group v-model="filters[colorAttribute.id]"  @change="handleColorChange">
                                <el-checkbox v-for="item in colorAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="colorSystemAttribute">
                        <el-collapse-item title="色系" name='4' >
                            <el-checkbox-group v-model="filters[colorSystemAttribute.id]" @change="handleColorSystemChange">
                                <el-checkbox v-for="item in colorSystemAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="timeOfDayAttribute">
                        <el-collapse-item title="一天中的时段" name='5'>
                            <el-checkbox-group v-model="filters[timeOfDayAttribute.id]" @change="handleTimeOfDayChange">
                                <el-checkbox v-for="item in timeOfDayAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="lightingAttribute">
                        <el-collapse-item title="灯光类型" name='6'>
                            <el-checkbox-group v-model="filters[lightingAttribute.id]"  @change="handleLightingChange">
                                <el-checkbox v-for="item in lightingAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="illuminationAttribute">
                        <el-collapse-item title="照明类型" name='7' >
                            <el-checkbox-group v-model="filters[illuminationAttribute.id]" @change="handleIlluminationChange">
                                <el-checkbox v-for="item in illuminationAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="shotTypeAttribute">
                        <el-collapse-item title="景别" name='8' >
                            <el-checkbox-group v-model="filters[shotTypeAttribute.id]" @change="handleShotTypeChange">
                                <el-checkbox v-for="item in shotTypeAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="cameraAngleAttribute">
                        <el-collapse-item title="摄像机角度" name='9' >
                            <el-checkbox-group v-model="filters[cameraAngleAttribute.id]" @change="handleCameraAngleChange">
                                <el-checkbox v-for="item in cameraAngleAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="cameraMovementAttribute">
                        <el-collapse-item title="摄像机运动" name='10' >
                            <el-checkbox-group v-model="filters[cameraMovementAttribute.id]" @change="handleCameraMovementChange">
                                <el-checkbox v-for="item in cameraMovementAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="lensLanguageAttribute">
                        <el-collapse-item title="镜头语言" name='11' >
                            <el-checkbox-group v-model="filters[lensLanguageAttribute.id]" @change="handleLensLanguageChange">
                                <el-checkbox v-for="item in lensLanguageAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="aspectRatioAttribute">
                        <el-collapse-item title="画面比例" name='12' >
                            <el-checkbox-group v-model="filters[aspectRatioAttribute.id]" @change="handleAspectRatioChange">
                                <el-checkbox v-for="item in aspectRatioAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                    <template v-if="viewpointAttribute">
                        <el-collapse-item title="视点" name='13' >
                            <el-checkbox-group v-model="filters[viewpointAttribute.id]" @change="handleViewpointChange">
                                <el-checkbox v-for="item in viewpointAttribute.values" :key="item.id" :label="item.id">
                                    {{ item.name }}
                                </el-checkbox>
                            </el-checkbox-group>
                        </el-collapse-item>
                    </template>
                </el-collapse>
            </div>
            <div class="w-8/12 gallery-container" >
                <el-row :gutter="10">
                    <template v-for="item in shots">
                        <el-col :span="6" :key="item.id">
                            <div class="video-item h-48" @click="play(item)">
                                <el-image class="video-poster" :src="item.thumbnail" fit="cover"></el-image>
                                <div class="video-mask">
                                    <i class="el-icon-video-play text-6xl text-white"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <span>{{ item.duration | durationFormat }}</span>
                                <router-link :to="'/shots/'+ item.id +'/edit'" class="float-right"><i class="el-icon-edit"></i></router-link>
                                <a class="float-right cursor-pointer mr-2" @click="deleteShot(item)"><i class="el-icon-delete"></i></a>
                            </div>
                        </el-col>
                    </template>
                </el-row>
                <my-infinite-scroll @loadMore="loadMore"></my-infinite-scroll>
            </div>
        </div>
        <popover-player :src="videoSrc" :visible.sync="playerVisible" :play.sync="autoplay" :info="info"></popover-player>
        <el-backtop></el-backtop>
    </app-layout>
</template>

<script>
import AppLayout from '../layout/AppLayout.vue';
import PopoverPlayer from '../global/PopoverPlayer.vue';
import MyInfiniteScroll from '../global/MyInfiniteScroll.vue';

import { CONFIG } from '../../config.js';
import { mapActions } from 'vuex';

export default {
    components: {
        AppLayout,
        PopoverPlayer,
        MyInfiniteScroll,
    },
    data() {
        return {
            activeNames: [],

            keyword: "",
            shots: "",
            limit: 20,
            offset: 0,

            videoSrc: "",
            playerVisible: false,
            autoplay: false,
            info: null,

            genre: [],

            properties: [],
            filters: Object(),
            genreOptions: [],

            movie: null,

        }
    },
    computed: {
        // 角色性别选择器及选项
        rolesAndGenderAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '角色性别';
            });
            return options ? options : null;
        },
        // 色彩选择器及选项
        colorAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '色彩';
            });
            return options ? options : null;
        },
        // 色系选择器及选项
        colorSystemAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '色系';
            });
            return options ? options : null;
        },
        // 时段选择器及选项
        timeOfDayAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '一天中的时段';
            });
            return options ? options : null;
        },
        // 灯光类型选择器及选项
        lightingAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '灯光类型';
            });
            return options ? options : null;
        },
        // 照明类型选择器及选项
        illuminationAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '照明类型';
            });
            return options ? options : null;
        },
        // 景别选择器及选项
        shotTypeAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '景别';
            });
            return options ? options : null;
        },
        // 摄像机角度选择器及选项
        cameraAngleAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '摄像机角度';
            });
            return options ? options : null;
        },
        // 摄像机运动选择器及选项
        cameraMovementAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '摄像机运动';
            });
            return options ? options : null;
        },
        // 镜头语言选择器及选项
        lensLanguageAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '镜头语言';
            });
            return options ? options : null;
        },

        // 画面比例选择器及选项
        aspectRatioAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '画面比例';
            });
            return options ? options : null;
        },
        // 视点选择器及选项
        viewpointAttribute() {
            let options = this.properties.find((item) => {
                return item.hasOwnProperty('name') && item.name === '视点';
            });
            return options ? options : null;
        },
    },

    methods: {
        ...mapActions('properties', [
            'queryProperties',
        ]),

        ...mapActions('genres', [
            'getGenresAll'
        ]),

        ...mapActions('shots', [
            'getShot',
        ]),

        ...mapActions('movies', [
            'getMovie',
        ]),

        getShots(params) {
            this.$store.dispatch('shots/getShots', params )
                .then((response) => {
                    this.shots = response.shots;
                    this.offset += response.shots.length;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
        },

        loadMore() {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { 
                limit: this.limit,
                offset: this.offset
            });
            this.$store.dispatch('shots/getShots', query )
                .then((response) => {
                    this.shots = this.shots.concat(response.shots);
                    this.offset += response.shots.length;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
        },

        handleSearch() {
            let query = Object.assign({}, this.$route.query, {
                keyword: this.keyword,
                limit: this.limit,
                offset: 0
            });

            this.$router.replace({ path: '/search', query: query });
        },

        handleGenreChange(val) {
            console.log(val);
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { genre: val });

            this.$router.replace({ path: '/search', query: query });
        },

        // 选项变化时，重新生成查询字符串
        handleRolesAndGenderChange(val) {
            let filter = {};
            filter[this.rolesAndGenderAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleColorChange(val) {
            let filter = {};
            filter[this.colorAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleColorSystemChange(val) {
            let filter = {};
            filter[this.colorSystemAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleTimeOfDayChange(val) {
            let filter = {};
            filter[this.timeOfDayAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleLightingChange(val) {
            let filter = {};
            filter[this.lightingAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleIlluminationChange(val) {
            let filter = {};
            filter[this.illuminationAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleShotTypeChange(val) {
            let filter = {};
            filter[this.shotTypeAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleCameraAngleChange(val) {
            let filter = {};
            filter[this.cameraAngleAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleCameraMovementChange(val) {
            let filter = {};
            filter[this.cameraMovementAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleLensLanguageChange(val) {
            let filter = {};
            filter[this.lensLanguageAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleAspectRatioChange(val) {
            let filter = {};
            filter[this.aspectRatioAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },
        // 选项变化时，重新生成查询字符串
        handleViewpointChange(val) {
            let filter = {};
            filter[this.viewpointAttribute.id] = val;
            this.generateAttributesQueryStr(filter);
        },

        // filters 变化时，重新生成query string
        generateAttributesQueryStr(attribute) {
            let query = Object.assign({}, this.$route.query);
            let filters;
            if (query.hasOwnProperty('filters')) {
                filters = JSON.parse(query.filters);
                filters = Object.assign(filters, attribute);
            } else {
                filters = Object.assign({}, attribute);
            }
            query.filters = JSON.stringify(filters);

            this.$router.replace({ path: '/search', query: query });
        },

        play(item) {
            let id = item.id;
            this.getShot(id).then((response) => {
                this.info = response.shot;
            }).catch((error) => {
                console.log(error);
            });
            this.videoSrc = item.url;
            this.playerVisible = true;
            this.autoplay = true;
        },

        // 初始化过滤器
        initFilters(params) {
            if (params.hasOwnProperty('genre')) {
                let genre = [];
                this.genre =  genre.concat(params.genre);
            }
            if (params.hasOwnProperty('filters')) {
                this.filters = Object.assign(this.filters, JSON.parse(params.filters));
            }
        },

        //删除镜头
        deleteShot(item) {
            let vm = this;
            this.$confirm('此操作将永久删除该镜头, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                this.$store.dispatch('shots/deleteShot', item.id)
                .then((response) => {
                    let index = vm.shots.findIndex((element) => element.id === item.id );
                    if (index >= 0) {
                        vm.shots.splice(index, 1);
                    }
                    this.$message({
                        type: 'success',
                        message: '删除成功!'
                    });
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消删除'
                });          
            });
        },

        handleCloseMovie(movie) {
            this.movie = null;
            let query = Object.assign({}, this.$route.query);
            delete query.movieId;

            this.$router.replace({ path: '/search', query: query });
        }
    },

    created() {
        let params = {
            name: ['角色性别', '色彩', '色系', '一天中的时段', '灯光类型', '照明类型', '景别', '摄像机角度', '摄像机运动', '镜头语言', '画面比例', '视点']
        }

        this.queryProperties(params).then((response) => { 
            this.properties = response.properties;
            // 设置shot的属性列表（propertyId）
            this.properties.forEach((item) => {
                this.$set(this.filters, item.id, []);
            });

            this.initFilters(this.$route.query);
        }).catch((error) => {
            console.log(error);
        });

        this.getGenresAll().then((response) => {
            this.genreOptions = response.genres;
        });

        let query = Object.assign({}, this.$route.query);
        query = Object.assign(query, { 
            limit: this.limit,
            offset: this.offset
        });
        if (query.hasOwnProperty('movieId')) {
            this.getMovie(query.movieId).then((response) => {
                this.movie = response.movie;
            }).catch((error) => {
                console.log(error);
            })
        }
        this.getShots(query);
    },

    beforeRouteUpdate(to, from, next) {
        let params = to.query;
        this.initFilters(to.query);
        if (params.hasOwnProperty('movieId')) {
            this.getMovie(params.movieId).then((response) => {
                this.movie = response.movie;
            }).catch((error) => {
                console.log(error);
            })
        }
        delete params.limit;
        delete params.offset;
        this.$store.dispatch('shots/getShots', params )
            .then((response) => {
                this.shots = response.shots;
                next();
            }).catch((error) => {
                console.log(error);
            });
    }
}
</script>

<style scoped>
  .video-item {
      position: relative;
  }

  .video-item .el-image {
      display: block;
      width: 100%;
      height: 100%;
  }

  .video-item .video-mask {
      display: none;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
  }

  .video-item:hover .video-mask {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      background: #000;
      opacity: 0.7;
  }

  .gallery-container { 
      margin-left: 20vw;
  }

  .filter-container{
      height: 80vh;
  }
</style>
