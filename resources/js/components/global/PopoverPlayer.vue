<template>
    <div class="player fixed inset-0" v-bind:class="[ visible ? 'visible' : 'invisible']">
        <div class="player-container relative w-full h-full flex justify-items-center">
            <div class="flex relative w-11/12 lg:w-5/6 xl:w-5/6 sm:ml-2 md:m-auto lg:m-auto xl:m-auto self-center">
                <video ref="video" class="w-10/12" controls preload="auto">
                    <source :src="src" type="video/mp4">
                </video>
                <ul class="text-white ml-2 w-2/12">
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">片名&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.film }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">影片类型&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.genre | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">导演&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.director | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">演员&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.actors | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">时长&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.duration | durationFormat }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">标签&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.tags | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">角色性别&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.roles_and_gender }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">色彩&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.color }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">色系&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.color_system }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">灯光类型&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.lighting }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">照明类型&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.lighting_type }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">景别&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.shot_type | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">摄像机角度&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.camera_angle | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">摄像机运动&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.camera_movement | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">镜头语言&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.lens_language | format }}</span>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">视点&nbsp;&nbsp;:</span>
                        <span class="w-2/5 inline-block ml-2">{{ info.viewpoint }}</span>
                    </li>
                </ul>
                <div class="btn-group">
                    <button class="player-close-btn" @click="closePlayer">X</button>
                </div>
            </div>
        </div>
        <div class="mask">
        </div>
    </div>
</template>

<script>
export default {
    props: {
        visible: {
            type: Boolean,
            default: false,
        },

        play: {
            type: Boolean,
            default: false,
        },

        src: String,

        info: Object,
    },

    data() {
        return {
        }
    },

    filters: {
        format: function (value) {
            if (value) {
                value = JSON.parse(value);
                return value.reduce(function(accumulator, currentValue) {
                    return accumulator + " | " + currentValue;
                });
            }
            return "";
        }
    },

    watch: {
        play: function(val) {
            if (val) {
                this.$refs.video.addEventListener("loadeddata", () => {
                    this.$refs.video.play();
                });
            } else {
                this.$refs.video.pause();
            }
        },

        src: function(val) {
            if (val) {
                this.$refs.video.src = val;
            }
        }
    },

    methods: {
        closePlayer() {
            this.$emit('update:visible', false);
            this.$emit('update:play', false);
        }
    },

    mounted() {
        this.$nextTick(() => {
            document.body.appendChild(this.$el);
        });
    },

    created() {

    }
}
</script>

<style scoped>
  .player {
      z-index: 10;
  }
  .mask {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #000;
      opacity: 0.8;
      z-index: 2000
  }

  .player-container {
      z-index: 2001;
  }

  .player .btn-group {
      position: absolute;
      right: -40px;
      top: 0;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      color: white;
  }
  .player-close-btn {
      font-size: 30px;
      color: white;
      line-height: 1;
  }
</style>