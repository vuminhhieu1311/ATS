<template>
    <el-dialog
        :visible.sync="show"
        width="50%"
        :title="$t('education')"
        @close="close"
    >
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="top"
        >
            <el-form-item :label="$t('school name')" prop="schoolName">
                <el-input v-model="form.schoolName" />
            </el-form-item>
            <el-form-item :label="$t('field of study')" prop="fieldOfStudy">
                <el-input v-model="form.fieldOfStudy" />
            </el-form-item>
            <el-form-item :label="$t('degree')">
                <el-input v-model="form.degree" />
            </el-form-item>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-form-item :label="$t('start date')">
                        <el-date-picker
                            v-model="form.startDate"
                            value-format="yyyy-MM-dd"
                            format="dd/MM/yyyy"
                            type="date"
                        />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item :label="$t('end date')">
                        <el-date-picker
                            v-model="form.endDate"
                            value-format="yyyy-MM-dd"
                            format="dd/MM/yyyy"
                            type="date"
                        />
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item :label="$t('grade')">
                <el-input v-model="form.grade" />
            </el-form-item>
            <div class="flex justify-start pt-3">
                <el-button type="primary" class="capitalize" @click="submit($refs.form, submitForm)">
                    {{ $t("save changes") }}
                </el-button>
                <div class="ml-5">
                    <el-button
                        type="info"
                        plain
                        class="capitalize"
                        @click="resetForm"
                    >
                        {{ $t("reset") }}
                    </el-button>
                </div>
            </div>
        </el-form>
    </el-dialog>
</template>

<script>
    import formMixin from '~/mixins/form';

    export default {
        name: 'EducationList',

        mixins: [formMixin],

        data() {
            return {
                show: false,
                form: {
                    schoolName: null,
                    fieldOfStudy: null,
                    degree: null,
                    startDate: null,
                    endDate: null,
                    grade: null,
                    educationId: null,
                },
                rules: {
                    schoolName: 'name:school name|required|type:string',
                    fieldOfStudy: 'name: field of study|required|type:string',
                },
            };
        },

        methods: {
            async open(education) {
                this.show = true;
                this.form.schoolName = this.$get(education, 'school_name', null);
                this.form.fieldOfStudy = this.$get(education, 'field_of_study', null);
                this.form.degree = this.$get(education, 'degree', null);
                this.form.startDate = this.$get(education, 'start_date', null);
                this.form.endDate = this.$get(education, 'end_date', null);
                this.form.grade = this.$get(education, 'grade', null);
                this.form.educationId = this.$get(education, 'id', null);
            },
            close() {
                this.show = false;
                this.resetForm();
            },
            resetForm() {
                this.$refs.form.resetFields();
            },
            async submitForm(formData) {
                if (formData.educationId) {
                    const user = await this.$axios.$put(`education/${formData.educationId}`, {
                        ...formData,
                    });
                    this.$auth.setUser(user);
                    this.$message.success(this.$t('update successfully'));
                } else {
                    const user = await this.$axios.$post('education', {
                        ...formData,
                    });
                    this.$auth.setUser(user);
                    this.$message.success(this.$t('create successfully'));
                }

                this.close();
            },
        },
    };
</script>
