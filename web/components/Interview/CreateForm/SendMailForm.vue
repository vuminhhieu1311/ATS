<template>
    <el-form
        ref="form"
        :model="form"
        :rules="formRules"
        label-position="left"
    >
        <div class="bg-gray-50 p-8 pb-2 border">
            <p class="text-xl font-semibold mb-5">{{ $t('interview notification') }}</p>
            <el-form-item :label="$t('send mail to candidate')" prop="isSendMail" :error="serverErrors.isSendMail">
                <el-switch v-model="form.isSendMail" />
            </el-form-item>
            <div v-if="form.isSendMail">
                <el-form-item prop="mailTemplateId" :error="serverErrors.mailTemplateId">
                    <el-select
                        v-model="form.mailTemplateId"
                        class="w-full"
                        filterable
                        :placeholder="$t('mail template')"
                        @change="onChangeMailTemplate"
                    >
                        <el-option
                            v-for="template in mailTemplates"
                            :key="$get(template, 'id')"
                            :label="$get(template, 'name')"
                            :value="$get(template, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item prop="mailTitle" :error="serverErrors.mailTitle">
                    <el-input v-model="form.mailTitle" :placeholder="$t('mail title')" />
                </el-form-item>
                <TextEditor
                    :text="form.mailContent"
                    :placeholder="$t('mail content')"
                    @onChangeText="onChangeMailContent"
                />
            </div>
        </div>
        <div class="flex justify-end mt-5">
            <el-button type="info" plain @click="close">{{ $t('cancel') }}</el-button>
            <el-button type="info" @click="resetForm">{{ $t('reset') }}</el-button>
            <el-button
                type="primary"
                :loading="processing"
                @click="submit($refs.form, submitForm)"
            >
                {{ $t('submit') }}
            </el-button>
        </div>
    </el-form>
</template>
<script>
    import _map from 'lodash/map';
    import formMixin from '~/mixins/form';
    import TextEditor from '~/components/Shared/TextEditor.vue';

    export default {
        name: 'InterviewForm',

        components: {
            TextEditor,
        },

        mixins: [formMixin],

        props: {
            mailTemplates: {
                type: Array,
                required: true,
            },
            interview: {
                type: Object,
                required: true,
            },
            close: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                form: {
                    isSendMail: false,
                    mailTemplateId: null,
                    mailTitle: null,
                    mailContent: '',
                },
            };
        },

        methods: {
            async onChangeMailTemplate(val) {
                try {
                    const mailTemplate = await this.$axios.$get(`mail-templates/${val}/interviews/${this.interview.id}/fill-interview-mail`);

                    this.form.mailTitle = this.$get(mailTemplate, 'title', '');
                    this.form.mailContent = this.$get(mailTemplate, 'content', '');
                } catch (error) {
                    this.$handleError(error);
                }
            },
            onChangeMailContent(val) {
                this.form.mailContent = val;
            },
            resetForm() {
                this.$refs.form.resetFields();
            },
            async submitForm(formData) {
                if (this.form.isSendMail) {
                    await this.$axios.$put(`interviews/${this.interview.id}`, {
                        ...this.interview,
                        staffs: _map(this.$get(this.interview, 'interviewers', []), 'id'),
                        ...formData,
                    });
                }

                this.$message.success(this.$t('create successfully'));
                this.close();
            },
        },
    };
</script>
