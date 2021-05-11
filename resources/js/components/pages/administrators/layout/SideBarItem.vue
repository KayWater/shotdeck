<template>
    <div v-if="isSidebar">
        <template v-if="!route.children">
            <el-menu-item :index="basePath">{{ route.meta.title }}</el-menu-item>
        </template>
        <template v-else>
            <el-submenu :index="route.path">
            <template slot="title">
                {{ route.meta.title }}
            </template>
            <side-bar-item v-for="child in route.children" 
                :key="child.path" 
                :route="child"
                :is-nest="true"
                :base-path="resolvePath(child.path)"
            ></side-bar-item>
        </el-submenu>
        </template>
    </div>
</template>

<script>
export default {
    name: 'SideBarItem',

    props: {
        route: Object,
        basePath: {
            type: String,
            default: '',
        },
        isNest: {
            type: Boolean,
            default: false,
        }
    },

    data() {
        return {

        }
    },

    computed: {
        isSidebar() {
            return this.route.hasOwnProperty('meta') && this.route.meta.hasOwnProperty('sidebar') && this.route.meta.sidebar
        }
    },

    methods: {
        resolvePath(routePath) {
            return this.basePath + '/' + routePath;
        }
    },

    created() {

    }
}
</script>

<style scoped>

</style>