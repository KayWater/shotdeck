<template>
    <div class="w-full">
        <el-page-header @back="goBack" content="创建属性"></el-page-header>
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
                <el-button type="primary" @click="handleCreate" :disabled="isBusy">立即创建</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';

export default {
    components: {
    },

    data() {
        return {
            form: {
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
            'createProperty'
        ]),

        goBack() {
            this.$router.go(-1);
        },

        handleCreate() {
            this.isBusy = true;
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return;
                }
                this.createProperty(this.form).then((response) => {
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

    }
}
</script>

<style scoped>
</style>