<template>
    <div class="w-full">
        <div class="flex justify-end items-center">
            <CandidateFilter
                :jobs="$get(pipeline, 'jobs', [])"
                :job-id="jobId"
                :on-change-job="onChangeJob"
                :pipeline="pipeline"
                :pipelines="pipelines"
                :on-change-pipeline="onChangePipeline"
                :query="query"
                :update-query="updateQuery"
            />
            <PipelineSetting
                :pipeline="pipeline"
            />
        </div>
        <div v-if="pipeline" class="mt-5 w-full flex flex-row overflow-x-auto">
            <StageKanban
                v-for="stage in $get(pipeline, 'stages')"
                :key="$get(stage, 'id')"
                class="kanban mr-3"
                group="stage"
                :stage="stage"
                :pipeline="pipeline"
                :job-id="jobId"
                :staffs="staffs"
                :rooms="rooms"
                :mail-templates="mailTemplates"
                :assessment-forms="assessmentForms"
                :query="query"
            />
        </div>
        <div v-else class="mt-6 text-center">
            <p>{{ $t('no data') }}</p>
        </div>
    </div>
</template>

<script>
    import _find from 'lodash/find';
    import StageKanban from '~/components/Stage/Kanban/index.vue';
    import PipelineSetting from '~/components/Pipeline/List/PipelineSetting.vue';
    import CandidateFilter from '~/components/Pipeline/List/Filter/index.vue';

    export default {
        name: 'PipelinesPage',

        components: {
            StageKanban,
            PipelineSetting,
            CandidateFilter,
        },

        async asyncData({ $axios, query }) {
            const { data: pipelines } = await $axios.$get('pipelines');
            const pipeline = query.id ? pipelines.find(({ id }) => id === Number(query.id)) : pipelines[0];

            return {
                pipelines,
                pipeline,
            };
        },

        data() {
            return {
                jobId: 0,
                staffs: [],
                rooms: [],
                mailTemplates: [],
                assessmentForms: [],
                query: {},
            };
        },

        async fetch() {
            const [
                { data: staffs },
                { data: rooms },
                { data: mailTemplates },
                { data: assessmentForms },
            ] = await Promise.all([
                await this.$axios.$get('staffs'),
                await this.$axios.$get('rooms'),
                await this.$axios.$get('mail-templates'),
                await this.$axios.$get('assessment-forms'),
            ]);

            this.staffs = staffs;
            this.rooms = rooms;
            this.mailTemplates = mailTemplates;
            this.assessmentForms = assessmentForms;
        },

        methods: {
            onChangePipeline(value) {
                this.$router.push('/pipelines');
                this.pipeline = _find(this.pipelines, ['id', value]);
                this.jobId = 0;
            },
            updateQuery(value) {
                this.query = value;
            },
            onChangeJob(value) {
                this.jobId = value;
            },
        },
    };
</script>
