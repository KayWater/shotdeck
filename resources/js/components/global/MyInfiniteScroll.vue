<template>
    <div class="text-center">
        <slot>
            <template v-if="noMore">
                <p>No More Data</p>
            </template>
            <template v-else>
                {{ title }}
            </template>
        </slot>
    </div>
</template>

<script>
export default {
    props: {
        title: {
            type: String,
            default: '加载更多'
        },

        noMore: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {

        }
    },

    methods: {
        // 判断元素是否在视口内
        isInViewport() {
            let rect = this.$el.getBoundingClientRect();
            let clientHeight = window.innerHeight || document.documentElement.clientHeight;
            return (rect.top < clientHeight || rect.bottom <= 0);
        }
    },

    mounted() {
        // 监听scroll事件, 当无线滚动元素在视口内时，触发加载事件
        this.$nextTick(() => {
            let timer;
            window.addEventListener('scroll', ()=> {
                if (!this.isInViewport()) {
                    return ;
                }
                if (timer) {
                    clearTimeout(timer);
                }
                timer = setTimeout(() => {
                    this.$emit('loadMore');
                }, 200);
            })
        })
    },

    created() {

    }
}
</script>

<style scoped>

</style>