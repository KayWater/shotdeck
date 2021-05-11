<template>
    <div class="player fixed inset-0" v-bind:class="[ visible ? 'visible' : 'invisible']">
        <div class="player-container relative w-full h-full flex justify-items-center">
            <div class="flex relative w-11/12 lg:w-5/6 xl:w-5/6 sm:ml-2 md:m-auto lg:m-auto xl:m-auto self-center">
                <div class="w-10/12">
                    <video ref="video" class="w-full"  controls preload="auto">
                        <source :src="src" type="video/mp4">
                    </video>
                </div>
                <ul v-if="info" class="text-white ml-2 w-2/12 flex-none">
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">片名:</span>
                        <div class="inline-block w-3/5">
                        <span class="inline-block mx-1">{{ info.movie.name }}</span>
                        </div>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">类型:</span>
                        <div class="inline-block w-3/5">
                            <template v-for="genre in info.movie.genres">
                                <span :key="genre.id" class="mx-1">{{ genre.name }}</span>
                            </template>
                        </div>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">导演:</span>
                        <div class="inline-block w-3/5">
                        <template v-for="person in info.movie.people">
                            <span :key="person.id" class="mx-1">{{ person.name }}</span>
                        </template>
                        </div>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">演员:</span>
                        <div class="inline-block w-3/5">
                        <template v-for="person in info.people">
                            <span :key="person.id" class="mx-1">{{ person.name }}</span>
                        </template>
                        </div>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">时长:</span>
                        <div class="inline-block w-3/5">
                        <span class="mx-1">{{ info.duration | durationFormat }}</span>
                        </div>
                    </li>
                    <li class="flex">
                        <span class="w-2/5 inline-block text-right self-start">标签:</span>
                        <div class="inline-block w-3/5">
                        <template v-for="tag in info.tags">
                            <span :key="tag.id" class="mx-1">{{ tag.name }}</span>
                        </template>
                        </div>
                    </li>
                    <template v-for="attribute in info.attributes_str">
                        <li :key="attribute.id" class="flex">
                            <span class="w-2/5 inline-block text-right self-start">{{ attribute.name }}:</span>
                            <div class="inline-block w-3/5">
                                <template v-for="value in attribute.values">
                                    <span :key="value.id" class="mx-1">{{ value.name }}</span>
                                </template>
                            </div>
                        </li>
                    </template>
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