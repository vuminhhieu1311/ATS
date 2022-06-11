import _omit from 'lodash/omit';
import { ALL_STATUS } from '~/enums/job/job-status';
import { ALL_TYPE } from '~/enums/job/employment-type';

export default {
    data() {
        return {
            query: this.$get(this.$route, 'query', {}),
            pipelineId: this.$route.query.pipelineId ? Number(this.$get(this.$route, 'query.pipelineId')) : null,
            name: this.$get(this.$route, 'query.name', null),
            location: this.$get(this.$route, 'query.location', null),
            tag: this.$get(this.$route, 'query.tag', null),
            type: this.$get(this.$route, 'query.type', null),
            status: this.$get(this.$route, 'query.status', null),
            pipelines: [],
            tags: [],
            types: ALL_TYPE,
            statuses: ALL_STATUS,
        };
    },

    async fetch() {
        const { data: pipelines } = await this.$axios.$get('pipelines');

        this.pipelines = pipelines;
    },

    methods: {
        onChangeValue(key, value) {
            this.query = value
                ? { ...this.query, [key]: value }
                : _omit(this.query, key);
            this.$router.push({ query: this.query });
        },
        async onSearchJobTag(keyword) {
            try {
                const { data: tags } = await this.$axios.$get('jobs/tags', { params: { keyword } });
                this.tags = tags;
            } catch (error) {
                this.$handleError(error);
            }
        },
    },
};
