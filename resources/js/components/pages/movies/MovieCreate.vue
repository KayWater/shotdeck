<template>
    <app-layout>
        <div class="container mt-10">
            <p class="text-2xl">添加影片</p>
            <el-form 
                :model="form"
                :rules="rules"
                ref="form"
                label-width="100px"
                hide-required-asterisk
                class=" mt-4">
                <el-row >
                    <el-form-item label="海报">
                        <el-upload
                            class='avatar-uploader'
                            ref='poster'
                            accept="image/jpeg;image/png;image/jpg"
                            list-type="text"
                            :show-file-list="false"
                            :action="action"
                            :on-success="handlePosterUploadSuccess">
                            <img v-if="form.posterUrl" :src="form.posterUrl" class="avatar">
                            <i v-else class="el-icon-plus avatar-uploader-icon"></i>
                        </el-upload>
                    </el-form-item>

                    <el-form-item label="中文片名" prop="name">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item label="英文片名">
                        <el-input v-model="form.nameEn"></el-input>
                    </el-form-item>

                    <el-form-item label="影片类型">
                        <el-select v-model="form.genres" multiple
                        placeholder="请选择" >
                            <el-option v-for="item in genreOptions"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="地区">
                        <el-select v-model="form.regions" multiple
                        placeholder="请选择" >
                            <el-option v-for="item in regionOptions"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>

                    <el-form-item label="导演">
                        <el-select v-model="form.directors" 
                            multiple
                            filterable
                            remote
                            placeholder="请选择"
                            :remote-method="remoteDirectorOptionsSearch"
                            :loading="optionsLoading">
                            <el-option v-for="item in directorOptions"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                            </el-option>
                        </el-select>
                        <div class="">
                            <p>没有找到需要的导演?  <router-link to="/people/create"  target="_blank">点击添加</router-link></p>
                        </div>
                    </el-form-item>

                    <el-form-item label="演员">
                        <template v-for="(actor, index) in form.actors">
                            <el-row :key="index" type="flex">
                                <el-col :span="4">
                                    <el-select v-model="form.actors[index].id"
                                        multiple
                                        filterable
                                        remote
                                        :multiple-limit="1"
                                        :remote-method="remoteActorOptionsSearch">
                                    <el-option v-for="item in actorOptions"
                                            :key="item.id"
                                            :label="item.name"
                                            :value="item.id">
                                         </el-option>
                                    </el-select>
                                </el-col>
                               
                                <el-col :span="4">
                                    <el-select 
                                        v-model="form.actors[index].type"
                                        placeholder="出演方式">
                                        <el-option
                                            label="饰"
                                            value='1'>
                                        </el-option>
                                        <el-option
                                            label="配"
                                            value='2'>
                                        </el-option>
                                    </el-select>
                                </el-col>
                                <el-col :span="4">
                                    <el-input v-model="form.actors[index].name" class="inline-block" placeholder="饰演角色"></el-input>
                                </el-col>
                                <el-col :span="10">
                                    <el-input type="textarea" v-model="form.actors[index].description" class="inline-block" placeholder="角色描述"></el-input>
                                </el-col>
                                
                                <el-col :span="2">
                                     <el-button @click="deleteActor(index)">删除演员</el-button>
                                </el-col>
                            </el-row>
                        </template>
                        <div class="">
                            <el-button @click="addActor">添加演员</el-button>
                            <p>没有找到需要的演员? <router-link to="/people/create" target="_blank">点击添加</router-link></p>
                        </div>
                    </el-form-item>

                    <el-form-item label="简介">
                        <el-input v-model="form.intro" type="textarea"></el-input>
                    </el-form-item>
                    <el-form-item label="时长">
                        <el-input v-model="form.duration" placeholder="单位为分钟"></el-input>
                    </el-form-item>
                    <el-form-item label="上映时间">
                        <el-date-picker
                            v-model="form.releaseTime"
                            type="date"
                            value-format="yyyy-MM-dd"
                            placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item label="镜头数量">
                        <el-input v-model="form.shotCount"></el-input>
                    </el-form-item>

                    <el-form-item>
                        <el-button @click="handleCreateMovie">保存</el-button>
                    </el-form-item>
                </el-row>
            </el-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../layout/AppLayout.vue';
import { CONFIG } from '../../../config.js';
import { mapActions } from 'vuex';

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            action: CONFIG.API_URL + '/movies/poster/upload',

            form: {
                name: '',
                nameEn: '',
                posterUrl: '',
                intro: '',
                duration: '',
                releaseTime: '',
                shotCount: '',

                directors: [],
                actors: [],
                genres: [],
                regions: [],
            },

            rules: {
                name: [
                    { required: true, message: '请输入中文名', trigger: 'blur' }
                ]
            },

            genreOptions: [],
            regionOptions: [],
            directorOptions: [],
            actorOptions: [],

            optionsLoading: false,
            actor: null,
        }
    },
    computed: {
    },

    methods: {
        ...mapActions('genres', [
            'getGenresAll'
        ]),

        ...mapActions('regions', [
            'getRegionsAll'
        ]),

        ...mapActions('people', [
            'searchPeople',
        ]),

        ...mapActions('movies', [
            'createMovie',
        ]),

        handlePosterUploadSuccess(response, file) {
            this.form.posterUrl = response.url;
        },

        handleCreateMovie() {
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return ;
                }
                this.createMovie(this.form).then((response) => {
                    vm.$message({
                        message: '创建成功',
                        type: 'success',
                    });
                }).catch((error) => {
                    vm.$message({
                        message: '创建失败',
                        type: 'error',
                    });
                });
            });
        },

        remoteDirectorOptionsSearch(query) {
            if (query === '') {
                return ;
            }

            this.optionsLoading = true;
            let params = {
                query: query
            }

            this.searchPeople(params).then((response) => {
                this.directorOptions = response.people;
            }).catch((error) => {
                console.log(error);
            }).finally(() => {
                this.optionsLoading = false;
            });
        },

        remoteActorOptionsSearch(query) {
            if (query === '') {
                return ;
            }
            this.optionsLoading = true;
            let params = {
                query: query
            }

            this.searchPeople(params).then((response) => {
                this.actorOptions = response.people;
            }).catch((error) => {
                console.log(error);
            }).finally(() => {
                this.optionsLoading = false;
            });
        },

        addActor() {
            let actor = {
                id: null,
                type: '1',
                name: '',
                description: ''
            };

            this.form.actors.push(actor);
        },

        deleteActor(index) {
            this.form.actors.splice(index, 1);
        },
    },

    created() {
        this.getGenresAll().then((response) => {
            this.genreOptions = response.genres;
        });
        this.getRegionsAll().then((response) => {
            this.regionOptions = response.regions;
        });
    },
}
</script>

<style>
  .avatar-uploader .el-upload {
    border: 1px dashed #000000;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 135px;
    height: 201px;
    line-height: 201px;
    text-align: center;
  }
  .avatar {
    width: 135px;
    height: 201px;
    display: block;
  }
</style>
