import { ALLOWED_MINE_TYPES, FILE_MAX_SIZE } from '~/enums/resume/file-rules';

export default {
    props: {
        job: {
            type: Object,
            required: true,
        },
    },

    data() {
        const validateResume = (rule, value, callback) => {
            if (value) {
                if (!ALLOWED_MINE_TYPES.includes(value.type)) {
                    callback(new Error('The file format is invalid'));
                } else if (value.size > FILE_MAX_SIZE) {
                    callback(new Error('The file is too large'));
                } else {
                    callback();
                }
            }
        };

        return {
            form: {
                name: null,
                email: null,
                phoneNumber: null,
                resume: null,
            },
            fileList: [],
            sources: [],
            rules: {
                name: [
                    { required: true, message: 'Name is required' },
                ],
                email: [
                    { required: true, message: 'Email is required' },
                    { type: 'email', message: 'Invalid email', trigger: ['blur', 'change'] },
                ],
                phoneNumber: [
                    { required: true, message: 'Phone number is required' },
                ],
                resume: [
                    { required: true, message: 'Resume is required' },
                    { validator: validateResume },
                ],
            },
        };
    },

    methods: {
        async submitForm(form) {
            try {
                const formData = new FormData();
                formData.append('name', form.name);
                formData.append('email', form.email);
                formData.append('phoneNumber', form.phoneNumber);
                formData.append('resume', form.resume, form.resume.name);

                await await this.$axios.$post(`jobs/${this.job.id}/candidates`, formData);

                this.$alert(this.$t('apply_successfully'), this.$t('congratulations'), {
                    confirmButtonText: this.$t('close'),
                    callback: () => {
                        this.$router.push('/ats');
                    },
                });
            } catch (error) {
                this.$handleError(error);
            }
        },
        changeFileList() {
            this.fileList = this.$refs.upload.uploadFiles;
            if (this.fileList.length === 2) {
                this.fileList.splice(0, 1);
            }
            this.form.resume = this.$get(this.fileList, '0.raw', null);
        },
        removeFile() {
            this.form.resume = null;
        },
    },
};
