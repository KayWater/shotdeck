<template>
    <app-layout>
        <template slot="header">
            <div class="leading-loose border-b border-gray-400">
                <template v-if="!isLogined">
                </template>
                <template v-else-if="isAdmin && currentUser">
                    <div class="flex justify-end">
                        <a class="mr-2">{{ currentUser.name }}</a>
                        <a class="cursor-pointer" @click="handleLogout">退出</a>
                    </div>
                </template>
            </div>
        </template>
        <div class="flex">
            <div class="fixed w-2/12 h-full">
                <el-menu
                default-active="2"
                router
                class="el-menu-vertical-demo h-full">
                    <el-submenu index="1">
                        <template slot="title">
                            <span>属性管理</span>
                        </template>
                        <el-menu-item index="/properties">属性</el-menu-item>
                        <el-menu-item index="1-2">属性值</el-menu-item>
                    </el-submenu>
                    <el-menu-item index="2">
                        <i class="el-icon-menu"></i>
                        <span slot="title">导航二</span>
                    </el-menu-item>
                    <el-menu-item index="3" disabled>
                        <i class="el-icon-document"></i>
                        <span slot="title">导航三</span>
                    </el-menu-item>
                    <el-menu-item index="4">
                        <i class="el-icon-setting"></i>
                        <span slot="title">导航四</span>
                    </el-menu-item>
                </el-menu>
            </div>
            <div class="main">
                <router-view></router-view>
            </div>
        </div>
    </app-layout>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
import AppLayout from '../../layout/AppLayout.vue';

export default {
    components: {
        AppLayout,
    },

    computed: {
        /**
         * Current user
         */
        currentUser() {
            return this.$store.state.users.currentUser;
        },
        
        ...mapGetters('auth', [
            'isLogined',
            'isAdmin',
        ]),
    },

    methods: {
        ...mapActions('auth/administrators', [
            'logout',
        ]),

        ...mapMutations('users', [
            'setCurrentUser',
        ]),

        handleLogout() {
            this.logout().then((response) => {
                this.setCurrentUser(null);
                this.$router.push('/');
            });
        }
    },

    created() {
        console.log(this.currentUser)
    }
}
</script>

<style scoped>
.main {
    margin-left: 20vw;
}
</style>