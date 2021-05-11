<template>
    <app-layout>
        <router-view></router-view>
    </app-layout>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

import AdministratorHeader from '../administrators/layout/Header.vue';
import AppLayout from '../administrators/layout/App.vue';

export default {
    components: {
        AppLayout,
        AdministratorHeader,
    },

    data() {
        return {
            properties: [],

            limit: 15,
            offset: 0,
            total: 0,
        }
    },

    computed: {
    },

    methods: {
        ...mapActions('properties', [
            'getProperties',
        ]),

        handleLogout() {
            this.logout().then((response) => {
                this.setCurrentUser(null);
                this.$router.push('/');
            });
        }
    },

    created() {
        // let params = {
        //     limit: this.limit,
        //     offset: this.offset,
        // };
        // this.getProperties(params).then((response) => {
        //     this.properties = response.properties;
        //     this.offset = response.properties.length;
        //     this.total = response.count;
        // }).catch((error) => {
        //     console.log(error);
        // });
    }
}
</script>

<style scoped>
.main {
    margin-left: 20vw;
}
</style>