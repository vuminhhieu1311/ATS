import _omit from 'lodash/omit';

export default {
    data() {
        return {
            query: this.$get(this.$route, 'query', {}),
            keyword: this.$get(this.$route, 'query.keyword', null),
            jobId: this.$route.query.jobId ? Number(this.$get(this.$route, 'query.jobId')) : null,
            pipelineId: this.$route.query.pipelineId ? Number(this.$get(this.$route, 'query.pipelineId')) : null,
            stageId: this.$route.query.stageId ? Number(this.$get(this.$route, 'query.stageId')) : null,
            isStar: Boolean(this.$get(this.$route, 'query.isStar', null)),
            jobs: [],
            pipelines: [],
            stages: [],
        };
    },

    async fetch() {
        const [
            { data: jobs },
            { data: pipelines },
            { data: stages },
        ] = await Promise.all([
            this.$axios.$get('jobs'),
            this.$axios.$get('pipelines'),
            this.$axios.$get('stages'),
        ]);

        this.jobs = jobs;
        this.pipelines = pipelines;
        this.stages = stages;
    },

    methods: {
        onChangeValue(key, value) {
            this.query = value
                ? { ...this.query, [key]: value }
                : _omit(this.query, key);
            this.$router.push({ query: this.query });
        },
        // async onSearchJobName(keyword) {
        //     try {
        //         const { data: { data: jobNames } } = await getJobNames({ keyword });
        //         this.jobNames = jobNames;
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
        // async onSearchStageName(keyword) {
        //     try {
        //         const { data: { data: stageNames } } = await getStageNames({ keyword });
        //         this.stageNames = stageNames;
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
        // async onSearchSourceName(keyword) {
        //     try {
        //         const { data: { data: sourceNames } } = await getSourceNames({ keyword });
        //         this.sourceNames = sourceNames;
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
        // async onSearchPipelineName(keyword) {
        //     try {
        //         const { data: { data: pipelineNames } } = await getPipelineNames({ keyword });
        //         this.pipelineNames = pipelineNames;
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
        // async onSearchCandidateTag(keyword) {
        //     try {
        //         // const { data: { data: candidateTags } } = await getTags({ keyword, type: CANDIDATE });
        //         // this.candidateTags = candidateTags;
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
    },
};
