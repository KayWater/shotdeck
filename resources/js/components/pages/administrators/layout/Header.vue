<template>
    <div class="leading-loose border-b border-gray-400 fixed">
        <template v-if="!isLogined">
        </template>
        <template v-else-if="isAdmin && currentUser">
            <div class="flex justify-end mr-4">
                <span class="mr-2">{{ currentUser.name }}</span>
                <a class="cursor-pointer" @click="handleLogout">退出</a>
            </div>
        </template>
    </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions } from 'vuex';
export default {

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
        ...mapMutations('users', [
            'setCurrentUser',
        ]),

        ...mapActions('auth/administrators', [
            'logout',
        ]),

        handleLogout() {
            this.logout().then((response) => {
                this.setCurrentUser(null);
                this.$router.push('/');
            });
        },
    }
}
</script>

<style scoped>

</style>