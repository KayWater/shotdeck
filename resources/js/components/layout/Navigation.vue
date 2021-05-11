<template>
    <div class="container flex justify-between leading-10">
        <h2 class="text-xl leading-10"><router-link :to="{ path : '/' }">首页</router-link></h2>
        <div class="inline-block">
            <template v-if="!isLogined">
                <router-link class="float-right mr-2" to="/register">注册</router-link>
                <router-link class="float-right mr-2" to="/login">登录</router-link>
            </template>
            <template v-else-if="!isAdmin && currentUser">
                <p class="float-right">{{ currentUser.name }}</p>
            </template>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
    name: 'navigation',

    computed: {
        ...mapGetters('auth', [
            'isLogined',
            'isAdmin',
        ])
    }
}
</script>

<style scoped>

</style>