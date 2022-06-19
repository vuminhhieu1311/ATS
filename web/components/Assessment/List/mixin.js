import _omit from 'lodash/omit';

export default {
    props: {
        assessmentForms: {
            type: Array,
            required: true,
        },
        searchAssessmentForms: {
            type: Function,
            required: true,
        },
        deleteAssessmentForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            query: {},
            name: null,
            createdAt: null,
        };
    },

    methods: {
        onChangeValue(key, value) {
            this.query = value
                ? { ...this.query, [key]: value }
                : _omit(this.query, key);

            this.searchAssessmentForms(this.query);
        },
    },
};
