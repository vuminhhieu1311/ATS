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
                // if (!ALLOWED_MINE_TYPES.includes(value.type)) {
                //     callback(new Error('The file format is invalid'));
                // } else if (value.size > FILE_MAX_SIZE) {
                //     callback(new Error('The file is too large'));
                // } else {
                    callback();
                // }
            }
        };

        return {
            form: {
                name: null,
                email: null,
                phone_number: null,
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
                phone_number: [
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
                console.log(form);
                // const formData = new FormData();
                // formData.append('image', form.resume, form.resume.name);
                // formData.append('bucket', HIRING);
                // formData.append('prefix', RESUME);
                // const { data: { data: resumeFile } } = await uploadResume(formData);

                // await createCandidate(this.$get(this.job, 'id'), {
                //     ...form,
                //     resume_id: this.$get(resumeFile, 'uuid', null),
                // });

                this.$alert(this.$t('apply_successfully'), this.$t('congratulations'), {
                    confirmButtonText: this.$t('close'),
                    callback: () => {
                        this.$router.push('/landing');
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
