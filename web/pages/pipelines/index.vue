<template>
    <div class="w-full">
        <div class="flex justify-between">
            <div>
                <nuxt-link to="/candidates/create">
                    <el-button type="primary" class="capitalize">
                        <span class="material-icons mr-1">add</span>
                        {{ $t('candidate') }}
                    </el-button>
                </nuxt-link>
            </div>
            <div class="flex justify-end items-center">
                <JobSelect
                    :jobs="$get(pipeline, 'jobs', [])"
                    :job-id="jobId"
                    :on-change-job="onChangeJob"
                />
                <PipelineSelect
                    :pipeline="pipeline"
                    :pipelines="pipelines"
                    :on-change-pipeline="onChangePipeline"
                />
                <PipelineSetting
                    :pipeline="pipeline"
                />
            </div>
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
                :mail-templates="mailTemplates"
            />
        </div>
        <div v-else class="mt-6 text-center">
            <p>{{ $t('no data') }}</p>
        </div>
        <!-- <InterviewList
            ref="list"
            :interviewers="interviewers"
            :mail-templates="mailTemplates"
            :notification-templates="notificationTemplates"
            :notice-services="noticeServices"
            :interview-services="interviewServices"
            :get-services-form-interview="getServicesFormInterview"
        /> -->
    </div>
</template>

<script>
    import _each from 'lodash/each';
    import _find from 'lodash/find';
    import StageKanban from '~/components/Stage/Kanban/index.vue';
    import PipelineSelect from '~/components/Pipeline/List/PipelineSelect.vue';
    import JobSelect from '~/components/Pipeline/List/JobSelect.vue';
    import PipelineSetting from '~/components/Pipeline/List/PipelineSetting.vue';
    // import InterviewList from '~/components/Interview/Modal/InterviewList/index.vue';

    export default {
        name: 'PipelinesPage',

        components: {
            StageKanban,
            JobSelect,
            PipelineSelect,
            PipelineSetting,
            // InterviewForm,
            // InterviewList,
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
                mailTemplates: [],
            };
        },

        async fetch() {
            const [
                { data: mailTemplates },
            ] = await Promise.all([
                await this.$axios.$get('mail-templates'),
            ]);

            this.mailTemplates = mailTemplates;
        },

        methods: {
            onChangePipeline(value) {
                this.$router.push('/pipelines');
                this.pipeline = _find(this.pipelines, ['id', value]);
                this.jobId = 0;
            },
            handleStageChanged(data) {
                _each(this.$get(this.pipeline, 'stages'), (item) => {
                    if (item.id === this.$get(data, 'stage.id')) {
                        item.candidatesCount += 1;
                    }
                });

                try {
                    // updateStageCandidate(
                    //     this.$get(data, 'candidate.id'),
                    //     this.$get(data, 'stage.id'),
                    // );
                } catch (error) {
                    this.$handleError(error);
                }
            },
            handleCandidateRemovedFromStage(data) {
                _each(this.$get(this.pipeline, 'stages'), (item) => {
                    if (item.id === this.$get(data, 'stage.id')) {
                        item.candidatesCount -= 1;
                    }
                });
            },
            // async showCandidateInterviews(stageId, candidateId) {
            //     try {
            //         const { data: { data: interviews } } = await getCandidateInterviewsByStage(stageId, candidateId);
            //         this.$refs.list.open(interviews);
            //     } catch (error) {
            //         this.$handleError(error);
            //     }
            // },
            onChangeJob(value) {
                this.jobId = value;
            },
        },
    };
</script>
