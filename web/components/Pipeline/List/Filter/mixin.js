import _omit from 'lodash/omit';

export default {
    props: {
        jobs: {
            type: Array,
            required: true,
        },
        pipelines: {
            type: Array,
            required: true,
        },
        jobId: {
            type: Number,
            default: 0,
        },
        onChangeJob: {
            type: Function,
            required: true,
        },
        pipeline: {
            type: Object,
            required: true,
        },
        onChangePipeline: {
            type: Function,
            required: true,
        },
        query: {
            type: Object,
            required: true,
        },
        updateQuery: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            isStar: this.$get(this.query, 'isStar', false),
            candidate: this.$get(this.query, 'candidate', null),
        };
    },

    methods: {
        onChangeValue(key, value) {
            const query = value
                ? { ...this.query, [key]: value }
                : _omit(this.query, key);

            this.updateQuery(query);
        },
    },
};
