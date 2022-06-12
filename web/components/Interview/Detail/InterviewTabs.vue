<template>
    <div class="interview-tabs mt-5">
        <el-tabs
            type="card"
            class="w-full mb-6 shadow-lg rounded-lg border-0"
        >
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">event_available</span>
                    <span>{{ $t("interview info") }}</span>
                </div>
                <InterviewInfo :interview="interview" />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">account_box</span>
                    <span>{{ $t("resume") }}</span>
                </div>
                <div>
                    <embed
                        width="100%"
                        height="800"
                        :src="resumeUrl"
                        type="application/pdf"
                    >
                </div>
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">assessment</span>
                    <span>{{ $t("all assessments") }}</span>
                </div>
                <AllAssessments :interview="interview" />
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import moment from 'moment';
    import AllAssessments from './AllAssessments.vue';
    import InterviewInfo from './InterviewInfo.vue';

    export default {
        components: {
            AllAssessments,
            InterviewInfo,
        },

        props: {
            interview: {
                type: Object,
                required: true,
            },
        },

        computed: {
            resumeUrl() {
                const baseUrl = process.env.BACKEND_URL;
                const link = this.$get(this.interview, 'candidateJob.candidate.resumeUrl');

                return `${baseUrl}${link}`;
            },
        },

        methods: {
            time(time) {
                return moment(time).format('DD/MM/YYYY LT');
            },
        },
    };
</script>
