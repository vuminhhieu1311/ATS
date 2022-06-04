import _cloneDeep from 'lodash/cloneDeep';
import _assign from 'lodash/assign';

export default {
    props: {
        stage: Object,
    },

    data() {
        const stage = _cloneDeep(this.stage);

        return {
            show: false,
            loading: false,
            form: _assign({
                name: null,
            }, stage || {}),
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
            this.loading = false;
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
