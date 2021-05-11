<template>
    <div class="w-full">
        <el-table :data="propertyValues">
            <el-table-column prop="name" label="属性值名"> </el-table-column>
            <el-table-column prop="status" label="状态"> </el-table-column>
            <el-table-column prop="property.name" label="所属属性"> </el-table-column>
            <el-table-column>
                <!-- <template slot="header" >
                    <router-link to="/properties/create"><i class="el-icon-plus"></i></router-link>
                </template>
                <template slot-scope="scope">
                    <router-link :to="'/properties/' + scope.row.id"><i class="el-icon-arrow-right"></i></router-link>
                </template> -->
            </el-table-column>
        </el-table>
        <div class="block text-center mt-2">
            <el-pagination layout="prev, pager, next" 
            hide-on-single-page 
            :page-size="limit" 
            :total="total" 
            @current-change="handlePageChange">
            </el-pagination>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    data() {
        return {
            propertyValues: [],

            limit: 15,
            offset: 0,
            total: 0,
        }
    },

    computed: {
    },

    methods: {
        ...mapActions('propertyValues', [
            'getPropertyValues',
        ]),
        
        handlePageChange(current) {
            console.log(current);
            let params = {
                limit: this.limit,
                offset: (current - 1) * this.limit
            };

            this.getPropertyValues(params).then((response) => {
                this.propertyValues = response.propertyValues;
                this.offset = response.propertyValues.length;
                this.total = response.count;
            }).catch((error) => {
                console.log(error);
            })
        }
    },

    created() {
        let params = {
            limit: this.limit,
            offset: this.offset,
        };
        this.getPropertyValues(params).then((response) => {
            this.propertyValues = response.propertyValues;
            this.offset = response.propertyValues.length;
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