<template>
    <el-menu class="el-menu-vertical"
        :router="true"
        :default-active="activeMenu"
    >
        <side-bar-item v-for="route in routes" 
            :key="route.path" 
            :route="route" 
            :base-path="route.path"
        ></side-bar-item>
    </el-menu>
</template>

<script>
import SideBarItem from './SideBarItem.vue';

export default {
    props: {
        routes: Array,
    },

    components: {
        SideBarItem,
    },

    data() {
        return {
            defaultOpends: ['1',],
        }
    },

    computed: {
        activeMenu() {
            const route = this.$route;
            const { meta, path } = route;
            
            if (meta.activeMenu) {
                return meta.activeMenu;
            }
            return path;
        }
    },
    
    methods: {
    },

    created() {
    }
}
</script>

<style scoped>
.el-menu-vertical {
    height: 100%;
    overflow-y: auto;
}
</style>

<style lang="scss" scoped>
.el-menu {
    //height: calc(100% - 121px);
}
</style>