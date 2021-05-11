<template>
    <div class="w-full">
        <el-page-header @back="goBack" content="编辑属性值"></el-page-header>

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
                <el-button type="primary" @click="handleUpdate" :disabled="isBusy">更新</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
    props: {
        pid: {
            type: [Number, String]
        },
        vid: {
            type: [Number, String]
        }
    },

    data() {
        return {
            property: {
                name: '',
            },

            form: {
                propertyId: this.pid,
                valueId: this.vid,
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
            'updatePropertyValue',
            'getPropertyValue',
        ]),

        goBack() {
            this.$router.go(-1);
        },

        handleGetPropertyValue(id) {
            this.getPropertyValue(id).then((response) => {
                let propertyValue = response.propertyValue;
                this.property = propertyValue.property;
                this.form.name = propertyValue.name;
            }).catch((error) => {
                console.log(error);
            });
        },

        handleUpdate() {
            this.isBusy = true;
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return;
                }
                this.updatePropertyValue(this.form).then((response) => {
                    this.$message({
                        message: '更新成功',
                        type: 'success',
                    });
                }).catch((error) => {
                    console.log(error);
                    this.$message({
                        message: '更新失败',
                        type: 'error',
                    });
                }).finally(() => {
                    setTimeout( () => {
                        this.isBusy = false;
                    }, 2000);
                })
            })
        }
    },

    created() {
        this.handleGetPropertyValue(this.vid);
    }
}
</script>

<style scoped>
</style>