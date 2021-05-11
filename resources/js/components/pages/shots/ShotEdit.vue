<template>
    <app-layout>
        <div class="container mt-10">
            <el-form 
                :model="form"
                ref="form"
                label-width="100px"
                hide-required-asterisk>
                <el-row :gutter='20'>
                    <el-col :span="12">
                        <el-form-item label="片名">
                            <el-select v-model="form.movieId">
                                <el-option v-for="item in movieOptions"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-form-item label="镜头">
                            <el-upload
                                class='upload'
                                ref='shotUpload'
                                accept="video/mp4"
                                list-type="text"
                                :action="action"
                                :limit=1
                                :auto-upload="false"
                                :on-remove="handleFileRemove"
                                :on-exceed="handleFileExceed"
                                :file-list='form.fileList'
                                :http-request='handleShotUpload'>
                                <el-button slot="trigger" size='small' 
                                    type='primary'>选取文件</el-button>
                                <el-button size='small' type='success'
                                    @click='submitShotUpload'>点击上传</el-button>
                                <div slot='tip' class='el-upload__tip'>只能上传.mp4文件</div>
                            </el-upload>
                        </el-form-item>
                       
                        <el-form-item label="演员">
                            <el-select v-model="form.actors"
                                multiple
                                filterable
                                remote
                                :remote-method="remoteActorOptionsSearch">
                                <el-option v-for="item in actorOptions"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </el-form-item>

                        <el-divider></el-divider>
                        <el-form-item label="角色性别">
                            <template v-if="rolesAndGenderAttribute">
                                <el-select v-model="form.attributes[rolesAndGenderAttribute.id]" placeholder="请选择">
                                    <el-option v-for="item in rolesAndGenderAttribute.values"
                                    :key="item.id"
                                    :label="item.name"
                                    :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="标签">
                            <el-input v-model="form.tags"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="色彩">
                            <template v-if="colorAttribute">
                                <el-select v-model="form.attributes[colorAttribute.id]" placeholder="请选择">
                                    <el-option v-for="item in colorAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="色系">
                            <template v-if="colorSystemAttribute">
                                <el-select v-model="form.attributes[colorSystemAttribute.id]" placeholder="请选择">
                                    <el-option v-for="item in colorSystemAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="一天中的时段">
                            <template v-if="timeOfDayAttribute">
                                <el-select v-model="form.attributes[timeOfDayAttribute.id]"
                                    placeholder="请选择">
                                    <el-option v-for="item in timeOfDayAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="灯光类型">
                            <template v-if="lightingAttribute">
                                <el-select v-model="form.attributes[lightingAttribute.id]"
                                placeholder="请选择">
                                    <el-option v-for="item in lightingAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="照明类型">
                            <template v-if="illuminationAttribute">
                                <el-select v-model="form.attributes[illuminationAttribute.id]"
                                    placeholder="请选择">
                                    <el-option v-for="item in illuminationAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="景别">
                            <template v-if="shotTypeAttribute">
                                <el-select v-model="form.attributes[shotTypeAttribute.id]" multiple
                                    placeholder="请选择">
                                    <el-option v-for="item in shotTypeAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="摄像机角度">
                            <template v-if="cameraAngleAttribute">
                                <el-select v-model="form.attributes[cameraAngleAttribute.id]" multiple
                                    placeholder="请选择">
                                    <el-option v-for="item in cameraAngleAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="摄像机运动">
                            <template v-if="cameraMovementAttribute">
                                <el-select v-model="form.attributes[cameraMovementAttribute.id]" multiple
                                    placeholder="请选择">
                                    <el-option v-for="item in cameraMovementAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="镜头语言">
                            <template v-if="lensLanguageAttribute">
                                <el-select v-model="form.attributes[lensLanguageAttribute.id]" multiple
                                    placeholder="请选择">
                                    <el-option v-for="item in lensLanguageAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="画面比例">
                            <template v-if="aspectRatioAttribute">
                                <el-select v-model="form.attributes[aspectRatioAttribute.id]"
                                    placeholder="请选择">
                                    <el-option v-for="item in aspectRatioAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item label="视点">
                            <template v-if="viewpointAttribute">
                                <el-select v-model="form.attributes[viewpointAttribute.id]"
                                    placeholder="请选择">
                                    <el-option v-for="item in viewpointAttribute.values"
                                        :key="item.id"
                                        :label="item.name"
                                        :value="item.id">
                                    </el-option>
                                </el-select>
                            </template>
                        </el-form-item>
                        <el-form-item>
                            <el-button @click="updateShot">更新</el-button>
                        </el-form-item>
                    </el-col>
                </el-row>
                <el-form-item>
                </el-form-item>
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

    props: {
        id: {
            type: [Number, String]
        }
    },

    data() {
        return {
            action: CONFIG.API_URL + '/shot/upload',

            form: {
                id: this.id,
                fileList: [],
                movieId: '',
                actors: [],
                attributes: Object(),
                tags: '',
            },

            properties: [],

            actorOptions: [],

            movieOptions:[],
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

        ...mapActions('people', [
            'searchPeople',
        ]),

        ...mapActions('movies', [
            'getMovies'
        ]),

        ...mapActions('shots', [
            'getShot',
        ]),
        
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

        /**
         * Handle file remove
         */
        handleFileRemove(file, fileList) {
            let index = this.form.fileList.findIndex(({uid}) => uid === file.uid);
            this.form.fileList.splice(index, 1);
        },

        /**
         * Handle file exceed
         */
        handleFileExceed() {
            this.$message({
                type: 'warning',
                message: '选择文件数量超出限制',
            });
        },

        /**
         * submit modelUpload
         */
        submitShotUpload() {
            this.$refs.shotUpload.submit();
        },

        /**
         * Handle material file upload
         */
        handleShotUpload(params) {
            let vm = this;
            console.log(this.form);
            vm._uploadChunk(params)
                .then((response) => {
                    vm.$message({
                        message: '上传成功',
                        type: 'success',
                    });
                    vm.$refs.form.clearValidate('fileList');
                    vm.form.fileList.push({
                        name: response.name,
                        url: response.path,
                        thumbnail: response.thumbnail ? response.thumbnail : '',
                        duration: response.duration,
                    });
                }).catch((error) => {
                    let message = error.message ? error.message : "上传失败";
                    vm.$message({
                        message: message,
                        type: 'error',
                    });
                })
        },

        /**
         * Upload actually
         */
        _uploadChunk(uploader, currentChunk=0) {
            return new Promise((resolve, reject) => {
                let vm = this;
                let file = uploader.file;
                // Return when file is empty.
                if (file.size === 0) {
                    reject({message: "文件不能为空文件"});
                    return;
                }
                let chunkSize = 1024 * 1024 * 4;  // Size of a single chunk
                let chunkCount = Math.ceil(file.size / chunkSize); // Count of the chunk 

                let start = currentChunk * chunkSize;  // Start position of current chunk
                let end = Math.min(file.size, start + chunkSize); // End position of current chunk
                let fileChunk = file.slice(start, end); // current chunk
                let formData = new FormData();

                formData.append('fileChunk', fileChunk);
                formData.append('fileName', file.name);
                formData.append('chunkIndex', currentChunk++);
                formData.append('chunkCount', chunkCount);

                axios.post(uploader.action, formData)
                    .then((response) => {
                        let uploadProgress = parseInt(currentChunk / chunkCount * 100);
                        uploader.onProgress({percent: uploadProgress});
                        if (currentChunk == chunkCount) {
                            resolve(response.data);
                            return ;
                        }
                        resolve(vm._uploadChunk(uploader, currentChunk));
                    }).catch((error) => {
                        reject(error.response.data);
                    })
            });
        },

        updateShot() {
            let vm = this;
            this.$store.dispatch('shots/updateShot', this.form)
            .then((response) => {
                vm.$message({
                    message: '更新成功',
                    type: 'success',
                });
            }).catch((error) => {
                vm.$message({
                    message: '更新失败',
                    type: 'error',
                });
            })
        },
    },

    created() {
        let params = {
            name: ['角色性别', '色彩', '色系', '一天中的时段', '灯光类型', '照明类型', '景别', '摄像机角度', '摄像机运动', '镜头语言', '画面比例', '视点']
        }

        let propertiesPromise = this.queryProperties(params);
        let moviePromise = this.getMovies();
        // 先获取选择器选项列表再获取镜头属性，初始化选中项
        Promise.all([propertiesPromise, moviePromise]).then((response) => {
            this.properties = response[0].properties;
            // 设置shot的属性列表（propertyId）
            this.properties.forEach((item) => {
                this.$set(this.form.attributes, item.id, '');
            });
            this.movieOptions = response[1].movies;
            return this.getShot(this.id);
        }).then((response) => {
            let shot = response.shot;
            this.form.movieId = parseInt(shot.movie_id);
            this.actorOptions = shot.people;
            this.form.actors = shot.people.map((item) => {
                return parseInt(item.id);
            });
            this.form.tags = shot.tags.reduce((accumulator, currentValue) => {
                return accumulator + ' ' + currentValue.name;
            }, '');
            this.form.attributes = Object.assign(this.form.attributes, shot.attributes);
        }).catch((error) => {
            console.log(error);
        })
    },
}
</script>

<style scoped>
  
</style>
