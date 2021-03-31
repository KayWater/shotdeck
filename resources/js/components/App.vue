<template>
    <app-layout>
        <template v-slot:header>
            <div class="container-fluid">
                <router-link class="float-right mr-2" to="/register">注册</router-link>
                <router-link class="float-right mr-2" to="/login">登录</router-link>
            </div>
        </template>
        <div class="container ">
            <div class="mt-64">
                <el-input placeholder="请输入内容" v-model="search">
                    <el-button slot="append" @click="handleSearch">搜索</el-button>
                </el-input>
            </div>
            <div class="mt-20 text-center">
                <router-link class="text-blue-500 text-2xl" to="/shot/create">上传镜头</router-link>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from './layout/AppLayout.vue';
import Navigation from './layout/Navigation.vue';

export default {
    components: {
        AppLayout,
        Navigation,
    },
    data() {
        return {
            search: '',
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
        handleSearch() {
            if (this.search) {
                this.$router.push({ path: 'search', query: { keyword : this.search } });
            } else {
                this.$router.push({ path: 'search' });
            }
        }
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

    beforeCreate() {
        
    }
}
</script>

<style scoped>
  
</style>
