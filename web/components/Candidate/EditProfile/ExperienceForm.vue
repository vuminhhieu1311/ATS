<template>
    <el-dialog
        :visible.sync="show"
        width="50%"
        :title="$t('working experience')"
        @close="close"
    >
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="top"
        >
            <el-form-item :label="$t('company name')" prop="companyName">
                <el-input v-model="form.companyName" />
            </el-form-item>
            <el-form-item :label="$t('position')" prop="position">
                <el-input v-model="form.position" />
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
            <el-form-item :label="$t('summary')">
                <el-input
                    v-model="form.summary"
                    type="textarea"
                    :rows="5"
                />
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
        name: 'ExperienceForm',

        mixins: [formMixin],

        data() {
            return {
                show: false,
                form: {
                    companyName: null,
                    position: null,
                    summary: null,
                    startDate: null,
                    endDate: null,
                    experienceId: null,
                },
                rules: {
                    companyName: 'name:company name|required|type:string',
                    position: 'required|type:string',
                },
            };
        },

        methods: {
            async open(experience) {
                this.show = true;
                this.form.companyName = this.$get(experience, 'company_name', null);
                this.form.position = this.$get(experience, 'position', null);
                this.form.summary = this.$get(experience, 'summary', null);
                this.form.startDate = this.$get(experience, 'start_date', null);
                this.form.endDate = this.$get(experience, 'end_date', null);
                this.form.experienceId = this.$get(experience, 'id', null);
            },
            close() {
                this.show = false;
                this.resetForm();
            },
            resetForm() {
                this.$refs.form.resetFields();
            },
            async submitForm(formData) {
                if (formData.experienceId) {
                    const user = await this.$axios.$put(`experiences/${formData.experienceId}`, {
                        ...formData,
                    });
                    this.$auth.setUser(user);
                    this.$message.success(this.$t('update successfully'));
                } else {
                    const user = await this.$axios.$post('experiences', {
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
