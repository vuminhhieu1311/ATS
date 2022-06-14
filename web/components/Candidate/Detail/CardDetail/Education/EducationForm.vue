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
        name: 'EducationForm',

        mixins: [formMixin],

        props: {
            submitForm: {
                type: Function,
                required: true,
            },
        },

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
                this.form.schoolName = this.$get(education, 'schoolName', null);
                this.form.fieldOfStudy = this.$get(education, 'fieldOfStudy', null);
                this.form.degree = this.$get(education, 'degree', null);
                this.form.startDate = this.$get(education, 'startDate', null);
                this.form.endDate = this.$get(education, 'endDate', null);
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
        },
    };
</script>
