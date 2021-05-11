<template>
    <el-table
        :data="properties">
        <el-table-column
            prop="name"
            label="属性名">
        </el-table-column>
        <el-table-column
            prop="status"
            label="状态">
        </el-table-column>
        <el-table-column
            prop="parent_id"
            label="是否父属性">
        </el-table-column>
        <el-table-column>
            <template slot="header" >
                <router-link to="/properties/create"><i class="el-icon-plus"></i></router-link>
            </template>
            <template slot-scope="scope">
                <router-link :to="'/properties/' + scope.row.id"><i class="el-icon-arrow-right"></i></router-link>
            </template>
        </el-table-column>
    </el-table>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
import AppLayout from '../../layout/AppLayout.vue';

export default {
    components: {
        AppLayout,
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
    },

    created() {
        let params = {
            limit: this.limit,
            offset: this.offset,
        };
        this.getProperties(params).then((response) => {
            this.properties = response.properties;
            this.offset = response.properties.length;
            this.total = response.count;
        }).catch((error) => {
            console.log(error);
        });
    }
}
</script>

<style scoped>
.main {
    margin-left: 20vw;
}
</style>