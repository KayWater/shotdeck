<template>
    <app-layout>
        <div class="container mt-48">
            <el-form :model="loginForm"
                :rules="rules"
                ref="loginForm"
                hide-required-asterisk
                class="w-1/2 p-8 m-auto border-2 border-gray-800">
                <h2 class="text-center text-2xl">管理员登陆</h2>
                <el-form-item label="邮箱">
                    <el-input v-model="loginForm.email" ></el-input>
                </el-form-item>
                <el-form-item label="密码">
                    <el-input v-model="loginForm.password" show-password></el-input>
                </el-form-item>
                <el-form-item >
                    <el-button class="w-full" @click="handleLogin">登录</el-button>
                </el-form-item>
            </el-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../../layout/AppLayout.vue';
import { mapActions } from 'vuex';

export default {
    components: {
        AppLayout,
    },

    data() {
        return {
            loginForm: {
                email: 'administrator@zfilmaker.com',
                password: 'administrator',
            },

            rules: {
                email: [
                    { required: true, type: "email", message: '请输入邮箱', trigger: 'blur' },
                ],
                password: [
                    { required: true, message: '请输入密码', trigger: 'blur' },
                    { min: 8, max: 18, message: '长度在 8 到 12 个字符', trigger: 'blur' }
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
        ...mapActions('auth/administrators', [
            'login',
        ]),

        handleLogin() {
            let vm = this;
            vm.$refs['loginForm'].validate((valid) => {
                if (!valid) {
                    return;
                }
                this.login(vm.loginForm).then((response) => {
                    vm.$router.push('/administrator/dashboard');
                }).catch((error) => {
                    console.log(error);
                })
            })
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
}
</script>

<style scoped>
  
</style>
