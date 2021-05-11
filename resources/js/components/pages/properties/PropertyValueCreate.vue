<template>
    <div class="w-full">
        <el-page-header @back="goBack" >
            <template slot="content">
                添加属性值
            </template>
        </el-page-header>

        <el-form
        ref="form"
        :model="form"
        :rules="rules"
        hide-required-asterisk
        class="w-1/3 p-6 mt-4 border border-gray-500">
            <el-form-item label="属性名">
                <el-input readonly v-model="property.name" disabled></el-input>
            </el-form-item>
            <el-form-item label="属性值" prop="name">
                <el-input v-model="form.name" placeholder="请输入属性名"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="handleCreate" :disabled="isBusy">立即创建</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: {
        id: {
            type: [Number, String]
        }
    },

    data() {
        return {
            property: {
                name: '',
            },

            form: {
                propertyId: this.id,
                name: '',
            },

            rules: {
                name: [
                    { required: true, message: '请输入属性名', trigger: 'blur' }
                ],
            },
            // 防止重复点击
            isBusy: false,
        }
    },

    computed: {
       
    },

    methods: {
        ...mapActions('properties', [
            'getProperty',
        ]),

        ...mapActions('propertyValues', [
            'createPropertyValue'
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

        handleGetProperty(id) {
            this.getProperty(id).then((response) => {
                this.property = response.property;
            }).catch((error) => {
                console.log(error);
            });
        },

        handleCreate() {
            this.isBusy = true;
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return;
                }
                this.createPropertyValue(this.form).then((response) => {
                    this.$message({
                        message: '创建成功',
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
        }
    },

    created() {
        this.handleGetProperty(this.id);
    }
}
</script>

<style scoped>
.main {
    margin-left: 20vw;
}
</style>