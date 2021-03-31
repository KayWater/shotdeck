<template>
    <app-layout>
        <div class="container-fluid mt-10 flex ">
            <div class="w-2/12 mr-4 fixed h-full">
                <el-input placeholder="请输入内容" v-model="keyword">
                    <el-button slot="append" @click="handleSearch">搜索</el-button>
                </el-input>
                <el-collapse v-model="activeNames" class="filter-container overflow-auto">
                    <el-collapse-item title="影片类型" name='1' >
                        <el-checkbox-group v-model="genre" @change="handleGenreChange">
                            <el-checkbox v-for="item in filters.genres" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="角色性别" name='2'>
                        <el-checkbox-group v-model="rolesAndGender" @change="handleRolesAndGenderChange">
                            <el-checkbox v-for="item in filters.rolesAndGender" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="色彩" name='3'>
                        <el-checkbox-group v-model="color"  @change="handleColorChange">
                            <el-checkbox v-for="item in filters.colors" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="色系" name='4' >
                        <el-checkbox-group v-model="colorSystem" @change="handleColorSystemChange">
                            <el-checkbox v-for="item in filters.colorSystem" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="一天中的时段" name='5'>
                        <el-checkbox-group v-model="timeOfDay" @change="handleTimeOfDayChange">
                            <el-checkbox v-for="item in filters.timeOfDay" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="灯光类型" name='6'>
                        <el-checkbox-group v-model="lighting"  @change="handleLightingChange">
                            <el-checkbox v-for="item in filters.lighting" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="照明类型" name='7' >
                        <el-checkbox-group v-model="lightingType" @change="handleLightingTypeChange">
                            <el-checkbox v-for="item in filters.lightingType" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="景别" name='8' >
                        <el-checkbox-group v-model="shotType" @change="handleShotTypeChange">
                            <el-checkbox v-for="item in filters.shotTypes" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="摄像机角度" name='9' >
                        <el-checkbox-group v-model="cameraAngle" @change="handleCameraAngleChange">
                            <el-checkbox v-for="item in filters.cameraAngle" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="摄像机运动" name='10' >
                        <el-checkbox-group v-model="cameraMovement" @change="handleCameraMovementChange">
                            <el-checkbox v-for="item in filters.cameraMovement" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="镜头语言" name='11' >
                        <el-checkbox-group v-model="lensLanguage" @change="handleLensLanguageChange">
                            <el-checkbox v-for="item in filters.lensLanguage" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="画面比例" name='12' >
                        <el-checkbox-group v-model="aspectRatio" @change="handleAspectRatioChange">
                            <el-checkbox v-for="item in filters.aspectRatio" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                    <el-collapse-item title="视点" name='13' >
                        <el-checkbox-group v-model="viewpoint" @change="handleViewpointChange">
                            <el-checkbox v-for="item in filters.viewpoint" :key="item.name" :label="item.name">
                            </el-checkbox>
                        </el-checkbox-group>
                    </el-collapse-item>
                </el-collapse>
            </div>
            <div class="w-8/12 gallery-container">
                <el-row :gutter="10">
                    <template v-for="item in shots">
                        <el-col :span="6" :key="item.id">
                            <div class="video-item h-48" @click="play(item)">
                                <el-image class="video-poster" :src="item.thumbnail" fit="cover"></el-image>
                                <div class="video-mask">
                                    <i class="el-icon-video-play text-6xl text-white"></i>
                                </div>
                            </div>
                            <p class="text-center">{{ item.duration | durationFormat }}</p>
                        </el-col>
                    </template>
                </el-row>
            </div>
        </div>
        <popover-player :src="videoSrc" :visible.sync="playerVisible" :play.sync="autoplay" :info="info"></popover-player>

    </app-layout>
</template>

<script>
import AppLayout from '../layout/AppLayout.vue';
import PopoverPlayer from '../global/PopoverPlayer.vue';

import { CONFIG } from '../../config.js';

export default {
    components: {
        AppLayout,
        PopoverPlayer,
    },
    data() {
        return {
            activeNames: [],

            keyword: "",
            shots: "",

            videoSrc: "",
            playerVisible: false,
            autoplay: false,
            info: {},

            genre: ['动作'],
            rolesAndGender: [],
            color: [],
            colorSystem: [],
            timeOfDay: [],
            lighting: [],
            lightingType: [],
            shotType: [],
            cameraAngle: [],
            cameraMovement: [],
            lensLanguage: [],
            aspectRatio: [],
            viewpoint: [],

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
        getShots(params) {
            this.$store.dispatch('shots/getShots', params )
                .then((response) => {
                    this.shots = response.shots;
                    console.log(response);
                }).catch((error) => {
                    console.log(error);
                });
        },

        handleSearch() {
            if (this.keyword) {
                this.$router.replace({ path: 'search', query: { keyword : this.keyword } });
            } else {
                this.$router.replace({ path: 'search' });
            }
        },

        handleGenreChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { genre: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleRolesAndGenderChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { rolesAndGender: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleColorChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { color: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleColorSystemChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { colorSystem: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleTimeOfDayChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { timeOfDay: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleLightingChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { lighting: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleLightingTypeChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { lightingType: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleShotTypeChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { shotType: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleCameraAngleChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { cameraAngle: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleCameraMovementChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { cameraMovement: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleLensLanguageChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { lensLanguage: val });
            
            this.$router.replace({ path: 'search', query: query });
        },

        handleAspectRatioChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { aspectRatio: val });

            this.$router.replace({ path: 'search', query: query });
        },

        handleViewpointChange(val) {
            let query = Object.assign({}, this.$route.query);
            query = Object.assign(query, { viewpoint: val });

            this.$router.replace({ path: 'search', query: query });
        },

        play(item) {
            this.videoSrc = item.url;
            this.playerVisible = true;
            this.autoplay = true;
            this.info =  item;
        },

        initFilters(params) {
            this.genre = params.hasOwnProperty('genre') ? params.genre : this.genre;
            this.rolesAndGender = params.hasOwnProperty('rolesAndGender') ? params.rolesAndGender : this.rolesAndGender
            this.color = params.hasOwnProperty('color') ? params.color : this.color
            this.colorSystem = params.hasOwnProperty('colorSystem') ? params.colorSystem : this.colorSystem
            this.timeOfDay = params.hasOwnProperty('timeOfDay') ? params.timeOfDay : this.timeOfDay
            this.lighting = params.hasOwnProperty('lighting') ? params.lighting : this.lighting
            this.lightingType = params.hasOwnProperty('lightingType') ? params.lightingType : this.lightingType
            this.shotType = params.hasOwnProperty('shotType') ? params.shotType : this.shotType
            this.cameraAngle = params.hasOwnProperty('cameraAngle') ? params.cameraAngle : this.cameraAngle
            this.cameraMovement = params.hasOwnProperty('cameraMovement') ? params.cameraMovement : this.cameraMovement
            this.aspectRatio = params.hasOwnProperty('aspectRatio') ? params.aspectRatio : this.aspectRatio
            this.viewpoint = params.hasOwnProperty('viewpoint') ? params.viewpoint : this.viewpoint
        }
    },

    created() {
        console.log('created: ')
        console.log(this.$route);
        this.keyword = this.$route.query.keyword;
        //this.initFilters(this.$route.query);
        this.getShots(this.$route.query);
        // if (!this.isLogined) {
        //     return;
        // }

        // this.$store.dispatch('user/loadCurrentUser')
        //     .then((response) => {

        //     }).catch((error) => {

        //     });
        // this.getShots();
    },

    beforeRouteUpdate(to, from, next) {
        let params = to.query;
        this.initFilters(to.query);
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
