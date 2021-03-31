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
                        <el-form-item>
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
                        <el-form-item label="片名">
                            <el-input v-model="form.filmName"></el-input>
                        </el-form-item>
                         <el-form-item label="影片类型">
                            <el-select v-model="form.genre" multiple
                            placeholder="请选择" >
                                <el-option v-for="item in filters.genres"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="导演">
                            <el-input v-model="form.director"></el-input>
                        </el-form-item>
                        <el-form-item label="演员">
                            <el-input v-model="form.actors"></el-input>
                        </el-form-item>
                        <el-divider></el-divider>
                        <el-form-item label="角色性别">
                            <el-select v-model="form.rolesAndGender"
                            placeholder="请选择">
                                <el-option v-for="item in filters.rolesAndGender"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="标签">
                            <el-input v-model="form.tags"></el-input>
                        </el-form-item>
                    </el-col>
                    <el-col :span="12">
                        <el-form-item label="色彩">
                            <el-select v-model="form.color"
                            placeholder="请选择">
                                <el-option v-for="item in filters.colors"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="色系">
                            <el-select v-model="form.colorSystem"
                            placeholder="请选择">
                                <el-option v-for="item in filters.colorSystem"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="一天中的时段">
                            <el-select v-model="form.timeOfDay"
                            placeholder="请选择">
                                <el-option v-for="item in filters.timeOfDay"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="灯光类型">
                           <el-select v-model="form.lighting"
                            placeholder="请选择">
                                <el-option v-for="item in filters.lighting"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="照明类型">
                            <el-select v-model="form.lightingType"
                            placeholder="请选择">
                                <el-option v-for="item in filters.lightingType"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="景别">
                            <el-select v-model="form.shotType" multiple
                                placeholder="请选择">
                                <el-option v-for="item in filters.shotTypes"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="摄像机角度">
                            <el-select v-model="form.cameraAngle" multiple
                                placeholder="请选择">
                                <el-option v-for="item in filters.cameraAngle"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="摄像机运动">
                            <el-select v-model="form.cameraMovement" multiple
                                placeholder="请选择">
                                <el-option v-for="item in filters.cameraMovement"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="镜头语言">
                            <el-select v-model="form.lensLanguage" multiple
                                placeholder="请选择">
                                <el-option v-for="item in filters.lensLanguage"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="画面比例">
                            <el-select v-model="form.aspectRatio"
                            placeholder="请选择">
                                <el-option v-for="item in filters.aspectRatio"
                                :key="item.value"
                                :label="item.name"
                                :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item label="视点">
                            <el-select v-model="form.viewpoint"
                                placeholder="请选择">
                                <el-option v-for="item in filters.viewpoint"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.name">
                                </el-option>
                            </el-select>
                        </el-form-item>
                        <el-form-item>
                            <el-button @click="createShot">保存</el-button>
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

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            action: CONFIG.API_URL + '/shot/upload',

            form: {
                fileList: [],
                filmName: '',
                genre: [],
                director: '',
                actors: '',

                rolesAndGender: '',
                tags: '',

                color: '',
                colorSystem: '',
                timeOfDay: '',
                lighting: '',
                lightingType: '',
                shotType: [],
                cameraAngle: [],
                cameraMovement: [],
                lensLanguage: [],
                aspectRatio: '',
                viewpoint: '',
               
            },

            filters: {
                // 影片类型
                genres: [
                    {
                        name: '剧情',
                        value: 1,
                    },
                    {
                        name: '喜剧',
                        value: 2,
                    },
                    {
                        name: '动作',
                        value: 3,
                    },
                    {
                        name: '爱情',
                        value: 4,
                    },
                    {
                        name: '科幻',
                        value: 5,
                    },
                    {
                        name: '动画',
                        value: 6,
                    },
                    {
                        name: '悬疑',
                        value: 7,
                    },
                    {
                        name: '惊悚',
                        value: 8,
                    },
                    {
                        name: '恐怖',
                        value: 9,
                    },
                    {
                        name: '犯罪',
                        value: 10,
                    },
                    {
                        name: '同性',
                        value: 11,
                    },
                    {
                        name: '音乐',
                        value: 12,
                    },
                    {
                        name: '歌舞',
                        value: 13,
                    },
                    {
                        name: '传记',
                        value: 14,
                    },
                    {
                        name: '历史',
                        value: 15,
                    },
                    {
                        name: '战争',
                        value: 16,
                    },
                    {
                        name: '西部',
                        value: 17,
                    },
                    {
                        name: '奇幻',
                        value: 18,
                    },
                    {
                        name: '冒险',
                        value: 19,
                    },
                    {
                        name: '灾难',
                        value: 20,
                    },
                    {
                        name: '武侠',
                        value: 21,
                    },
                    {
                        name: '情色',
                        value: 22,
                    }
                ],
                // 颜色
                colors: [
                    {
                        name: '红',
                        value: 1,
                    },
                    {
                        name: '黄',
                        value: 2,
                    },
                    {
                        name: '橙',
                        value: 3,
                    },
                    {
                        name: '蓝',
                        value: 4,
                    },
                    {
                        name: '绿',
                        value: 5,
                    },
                    {
                        name: '紫',
                        value: 6,
                    },
                ],
                //色系
                colorSystem: [
                    {
                        name: '冷色',
                        value: 1,
                    },
                    {
                        name: '暖色',
                        value: 2,
                    },
                ],
                // 时段
                timeOfDay: [
                    {
                        name: '黎明前',
                        value: 1,
                    },
                    {
                        name: '黎明',
                        value: 2,
                    },
                    {
                        name: '清晨',
                        value: 3,
                    },
                    {
                        name: '上午',
                        value: 4,
                    },
                    {
                        name: '中午',
                        value: 5,
                    },
                    {
                        name: '下午',
                        value: 6,
                    },
                    {
                        name: '傍晚',
                        value: 7,
                    },
                    {
                        name: '夜晚',
                        value: 8,
                    },
                    {
                        name: '深夜',
                        value: 9,
                    },
                    {
                        name: '凌晨',
                        value: 10,
                    }
                ],
                //灯光类型
                lighting: [
                    {
                        name: '高调',
                        value: 1,
                    },
                    {
                        name: '低调',
                        value: 2,
                    },
                    {
                        name: '高反差',
                        value: 3,
                    },
                    {
                        name: '背光',
                        value: 4,
                    },
                    {
                        name: '曝光过度',
                        value: 5,
                    }
                ],
                //照明类型
                lightingType: [
                    {
                        name: '户外自然',
                        value: 1,
                    },
                    {
                        name: '户外人工',
                        value: 2,
                    },
                    {
                        name: '室内自然',
                        value: 3,
                    },
                    {
                        name: '室内人工',
                        value: 4,
                    }
                ],
                //景别
                shotTypes: [
                    {
                        name: '大远景',
                        value: 1,
                    },
                    {
                        name: '远景',
                        value: 2,
                    },
                    {
                        name: '全景',
                        value: 3,
                    },
                    {
                        name: '中景',
                        value: 4,
                    },
                    {
                        name: '近景',
                        value: 5,
                    },
                    {
                        name: '特写',
                        value: 6,
                    },
                    {
                        name: '大特写',
                        value: 7,
                    },
                    {
                        name: '深焦镜头',
                        value: 8,
                    }
                ],
                // 摄像机角度
                cameraAngle: [
                    {
                        name: '鸟瞰',
                        value: 1,
                    },
                    {
                        name: '俯视',
                        value: 2,
                    },
                    {
                        name: '水平',
                        value: 3,
                    },
                    {
                        name: '90°仰视',
                        value: 4,
                    },
                    {
                        name: '仰视',
                        value: 5,
                    },
                    {
                        name: '倾斜',
                        value: 6,
                    },
                ],

                cameraMovement: [
                    {
                        name: '定',
                        value: 1,
                    },
                    {
                        name: '跟拍',
                        value: 2,
                    },
                    {
                        name: '推轨',
                        value: 3,
                    },
                    {
                        name: '横摇',
                        value: 4,
                    },
                    {
                        name: '上下直摇',
                        value: 5,
                    },
                    {
                        name: '升降镜头',
                        value: 6,
                    },
                    {
                        name: '伸缩镜头',
                        value: 7,
                    },
                    {
                        name: '手提摄影',
                        value: 8,
                    },
                    {
                        name: '空中摇摄',
                        value: 9,
                    },
                    {
                        name: '俯视旋转',
                        value: 10,
                    },
                ],

                
                // 镜头语言
                lensLanguage: [
                    {
                        name: '无',
                        value: 1,
                    },
                    {
                        name: '发现',
                        value: 2,
                    },
                    {
                        name: '后拉撤回',
                        value: 3,
                    },
                    {
                        name: '后拉揭示',
                        value: 4,
                    },
                    {
                        name: '扩展',
                        value: 5,
                    }, 
                    {
                        name: '精简',
                        value: 6,
                    },
                    {
                        name: '紧缩',
                        value: 7,
                    },
                    {
                        name: '引出',
                        value: 8,
                    },
                    {
                        name: '环绕',
                        value: 9,
                    },
                    {
                        name: '飞越',
                        value: 10,
                    },
                    {
                        name: '纵深移动',
                        value: 11,
                    },
                    {
                        name: '移动上摇',
                        value: 12,
                    },
                    {
                        name: '移动俯摇',
                        value: 13,
                    },
                    {
                        name: '环绕观看',
                        value: 14,
                    },
                    {
                        name: '穿越固体',
                        value: 15,
                    },
                    {
                        name: '眩晕',
                        value: 16,
                    },
                    {
                        name: '延伸移动',
                        value: 17,
                    },
                    {
                        name: '收缩移动',
                        value: 18,
                    },
                    {
                        name: '倒退移动',
                        value: 19,
                    },
                    {
                        name: '长镜头',
                        value: 20,
                    },
                    {
                        name: '延时揭示',
                        value: 21,
                    },
                    {
                        name: '升格',
                        value: 22,
                    },
                ],

                aspectRatio: [
                    {
                        name: '16：9',
                        value: 1,
                    },
                    {
                        name: '4:3',
                        value: 2,
                    },
                    {
                        name: '2.35:1',
                        value: 3,
                    },
                    {
                        name: '2.39:1',
                        value: 4,
                    },
                ],

                rolesAndGender: [
                    {
                        name: '一男',
                        value: '1',
                    },
                    {
                        name: '一女',
                        value: '2',
                    },
                    {
                        name: '一男一女',
                        value: '3',
                    },
                    {
                        name: '两男',
                        value: '4',
                    },
                    {
                        name: '两女',
                        value: '5',
                    },
                    {
                        name: '多人',
                        value: '6',
                    }
                ],

                viewpoint: [
                    {
                        name: '主观',
                        value: 1,
                    },
                    {
                        name: '带物主观',
                        value: 2,
                    },
                    {
                        name: '物体主观',
                        value: 3,
                    },
                    {
                        name: '旁视',
                        value: 4,
                    },
                    {
                        name: '直视摄像机',
                        value: 5,
                    },
                    {
                        name: '打破第四面墙',
                        value: 6,
                    },
                    {
                        name: '窥视',
                        value: 7,
                    },
                    {
                        name: '暗中偷窥',
                        value: 8,
                    },
                    {
                        name: '遮罩，镶边',
                        value: 9,
                    },
                    {
                        name: '筛滤',
                        value: 10,
                    },
                    {
                        name: '映像',
                        value: 11,
                    },
                    {
                        name: '插件视点',
                        value: 12,
                    },
                    {
                        name: '影子',
                        value: 13,
                    },
                    {
                        name: '剪影',
                        value: 14,
                    },
                    {
                        name: '随动',
                        value: 15,
                    }
                ]
            }
        }
    },
    computed: {
        /**
         * Current user
         */
        // currentUser() {
        //     return this.$store.state.user.currentUser;
        // },
        
        /**
         * Is logined
         */
        // isLogined() {
        //     return this.$store.getters['auth/isLogined'];
        // }
    },

    methods: {
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

        createShot() {
            let vm = this;
            this.$store.dispatch('shots/createShot', this.form)
            .then((response) => {
                vm.$message({
                    message: '创建成功',
                    type: 'success',
                });
                console.log(response);
            }).catch((error) => {
                vm.$message({
                    message: '创建失败',
                    type: 'error',
                });
            })
        },
    },


    created() {
        // if (!this.isLogined) {
        //     return;
        // }

        // this.$store.dispatch('user/loadCurrentUser')
        //     .then((response) => {

        //     }).catch((error) => {

        //     });
    },
}
</script>

<style scoped>
  
</style>
