<template>
    <app-layout>
        <div class="container mt-10">
            <h2 class="text-2xl">创建演职员</h2>
            <el-form 
                :model="form"
                ref="form"
                label-width="100px"
                hide-required-asterisk
                class="w-1/3 mt-4">
                <el-row :gutter='20'>
                    <el-form-item label="中文名">
                        <el-input v-model="form.name"></el-input>
                    </el-form-item>
                    <el-form-item label="英文名">
                        <el-input v-model="form.nameEn"></el-input>
                    </el-form-item>
                    <el-form-item label="性别">
                        <el-select v-model="form.gender"
                            placeholder="请选择" 
                            class="block">
                            <el-option v-for="item in genderOptions"
                            :key="item.value"
                            :label="item.label"
                            :value="item.value">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="国籍">
                        <el-select v-model="form.country"
                            placeholder="请选择"
                            class="block">
                            <el-option v-for="item in countryOptions"
                            :key="item.id"
                            :label="item.name"
                            :value="item.id">
                            </el-option>
                        </el-select>
                    </el-form-item>
                    <el-form-item label="出生日期">
                         <el-date-picker
                            v-model="form.birthday"
                            type="date"
                            value-format="yyyy-MM-dd"
                            placeholder="选择日期">
                        </el-date-picker>
                    </el-form-item>
                    <el-form-item>
                        <el-button @click="handleCreatePeople" :disabled="isBusy">保存</el-button>
                    </el-form-item>
                </el-row>
            </el-form>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '../../layout/AppLayout.vue';
import { mapActions } from 'vuex';

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            form: {
                name: '',
                nameEn: '',
                gender: null,
                birthday: '',
                country: null,
            },

            rules: {
                name: [
                    { required: true, message: '请输入中文名', trigger: 'blur' }
                ],
            },

            countryOptions: [],

            genderOptions: [
                {
                    value: 0,
                    label: '男'
                },
                {
                    value: 1,
                    label: '女'
                }
            ],

            // 防止重复点击
            isBusy: false,
        }
    },
    computed: {
    },

    methods: {

        ...mapActions('countries', [
            'getCountriesAll'
        ]),

        ...mapActions('people', [
            'createPeople',
        ]),

        handleCreatePeople() {
            this.isBusy = true;
            this.$refs['form'].validate((valid) => {
                if (!valid) {
                    return;
                }

                this.createPeople(this.form).then((response) => {
                    this.$message({
                        message: '演职员添加成功',
                        type: 'success'
                    })
                }).catch((error) => {
                    let message = error.message || '系统错误';
                    this.$message({
                        message: message,
                        type: 'error'
                    })
                }).finally(() => {
                    setTimeout(() => {
                        this.isBusy = false;
                    }, 2000);
                })
            })
        },
    },


    created() {
        this.getCountriesAll().then((response) => {
            this.countryOptions = response.countries;
        })
    },
}
</script>

<style scoped>
  
</style>
