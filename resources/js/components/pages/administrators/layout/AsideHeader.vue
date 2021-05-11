<template>
    <div class="bg-white">
        <template v-if="isAdmin && user">
            <div class='text-center'>
                <p>{{ user.name }}</p>
                <div class='bottom clearfix'>
                    <el-button type='text' @click='handleLogout'>注销</el-button>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import { mapGetters, mapActions, mapMutations } from 'vuex';

export default {
    props: {
        user: Object,
    },

    data() {
        return {

        }
    },

    computed: {
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
        
    }

}
</script>

<style scoped>

</style>