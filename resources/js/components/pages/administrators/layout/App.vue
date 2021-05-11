<template>
    <div class="flex flex-row h-full min-h-screen">
        <div class="aside h-full w-1/5 fixed">
            <aside-header :user="currentUser"></aside-header>
            <side-bar :routes="routes"></side-bar>
        </div>
        <div class="flex-grow main">
            <div class="mt-2 ml-2">
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import AsideHeader from './AsideHeader.vue'
import SideBar from './SideBar.vue'
export default {
    components: {
        AsideHeader,
        SideBar,
    },
    computed: {
        /**
         * Current user
         */
        currentUser() {
            return this.$store.state.users.currentUser;
        },

        routes() {
            return this.$store.state.routePermissions.routes;
        },

        ...mapGetters('auth', [
            'isLogined',
            'isAdmin',
        ]),
    },

    methods: {
        

        
    },

    created() {
    }
}
</script>

<style scoped>
    .main {
        margin-left: 20vw;
    }
</style>