import _map from 'lodash/map';

export default {
    props: {
        submitForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            show: false,
            questions: [],
            criterion: {},
            form: {
                name: null,
                questionIds: [],
                criterionId: null,
            },
            rules: {
                name: 'required|max:255',
            },
        };
    },

    async fetch() {
        const { data: questions } = await this.$axios.$get('questions');

        this.questions = questions;
    },

    methods: {
        open(criterion) {
            this.show = true;
            this.criterion = criterion;
            this.form.name = this.$get(criterion, 'name', null);
            this.form.questionIds = _map(this.$get(criterion, 'questions', []), ({ id }) => id);
            this.form.criterionId = this.$get(criterion, 'id', null);
        },
        close() {
            this.resetForm();
            this.show = false;
        },
        resetForm() {
            this.$refs.form.resetFields();
            this.form.questionIds = [];
        },
    },
};
