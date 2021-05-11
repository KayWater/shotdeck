<template>
    <div class="w-full">
        <el-page-header @back="goBack">
            <template slot="content">
                {{ form.name }}
            </template>
        </el-page-header>
        
        <el-form
        ref="form"
        :model="form"
        :rules="rules"
        hide-required-asterisk
        class="w-1/3 p-6 mt-4 border border-gray-500">
            <el-form-item label="属性名" prop="name">
                <el-input v-model="form.name" placeholder="请输入属性名"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleUpdate" :disabled="isBusy">更新</el-button>
            </el-form-item>
        </el-form>
        <div class="mt-8">
            <div class="text-2xl">属性值列表</div>
            <el-table
            :data="propertyValues"
            class="mt-2">
                <el-table-column
                prop="name"
                label="属性值">
                </el-table-column>
                <el-table-column
                prop="status"
                label="状态">
                </el-table-column>
                <el-table-column>
                    <template slot="header" >
                        <router-link :to="'/properties/' + id + '/values/create'"><i class="el-icon-plus"></i></router-link>
                    </template>
                    <template slot-scope="scope">
                        <router-link :to="'/properties/' + id + '/values/' + scope.row.id"><i class="el-icon-arrow-right"></i></router-link>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    components: {
    },

    props: {
        id: {
            type: [ Number, String ],
        }
    },

    data() {
        return {
            form: {
                id: this.id,
                name: '',
            },

            rules: {
                name: [
                    { required: true, message: '请输入属性名', trigger: 'blur' }
                ],
            },
            // 防止重复点击
            isBusy: false,

            propertyValues: [],
        }
    },

    computed: {
    },

    methods: {
        ...mapActions('properties', [
            'getProperty',
            'updateProperty',
            'getPropertyValuesByProperty',
        ]),

        ...mapActions('propertyValues', [
            'getPropertyValues',
        ]),

        handleLogout() {
            this.logout().then((response) => {
                this.setCurrentUser(null);
                this.$router.push('/');
            });
        },

        goBack() {
            this.$router.go(-1);
        },

        handleUpdate() {
            this.isBusy = true;
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return;
                }
                this.updateProperty(this.form).then((response) => {
                    this.form.name = response.property.name;
                    this.$message({
                        message: '更新成功',
                        type: 'success',
                    });
                }).catch((error) => {
                    console.log(error);
                }).finally(() => {
                    setTimeout( () => {
                        this.isBusy = false;
                    }, 2000);
                })
            })
        },

        async HandleGetProperty(id) {
            try {
                let response = await this.getPropertyValuesByProperty(id);
                this.form.name = response.property.name;
                this.propertyValues = response.property.values;
            } catch(e) {
                console.log(e);
            }
        }
    },

    created() {
        this.HandleGetProperty(this.id)
    }
}
</script>

<style scoped>
.main {
    margin-left: 20vw;
}
</style>