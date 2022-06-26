export default {
    data() {
        return {
            show: false,
            loading: false,
            form: {
                name: null,
            },
            rules: {
                name: 'required|max:255',
            },
        };
    },

    methods: {
        open() {
            this.show = true;
        },
        close() {
            this.resetForm();
            this.show = false;
        },
        resetForm() {
            this.$refs.form.resetFields();
        },
        async submitForm(formData) {
            const { data: stage } = await this.$axios.$post('stages', {
                ...formData,
            });
            this.$message.success(this.$t('create successfully'));
            this.$emit('addNewStage', stage);
            this.close();
        },
    },
};
