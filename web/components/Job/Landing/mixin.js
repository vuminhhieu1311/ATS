export default {
    props: {
        jobs: {
            type: Array,
            required: true,
        },
        loading: {
            type: Boolean,
            required: true,
        },
        query: {
            type: Object,
            required: true,
        },
        fetchJobs: {
            type: Function,
            required: true,
        },
        updateJobList: {
            type: Function,
            required: true,
        },
        updateQuery: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            name: '',
        };
    },

    methods: {
        onSearchJobs() {
            this.updateQuery({
                ...this.query,
                name: this.name,
            });
            this.updateJobList({});
            this.fetchJobs();
        },
    },
};
