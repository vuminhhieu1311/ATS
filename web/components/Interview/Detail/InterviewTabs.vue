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
                <el-descriptions :column="1" border>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-tickets" />
                            {{ $t('interview name') }}
                        </template>
                        {{ $get(interview, 'name') }}
                    </el-descriptions-item>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-mobile-phone" />
                            {{ $t('interview type') }}
                        </template>
                        <el-tag type="primary">
                            {{ interview.isOnline ? 'Online' : 'Offline' }}
                        </el-tag>
                    </el-descriptions-item>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-alarm-clock" />
                            {{ $t('start time') }}
                        </template>
                        {{ time($get(interview, 'startTime')) }}
                    </el-descriptions-item>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-alarm-clock" />
                            {{ $t('end time') }}
                        </template>
                        {{ time($get(interview, 'endTime')) }}
                    </el-descriptions-item>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-suitcase" />
                            {{ $t('position') }}
                        </template>
                        {{ $get(interview, 'candidateJob.job.name') }}
                    </el-descriptions-item>
                    <el-descriptions-item>
                        <template slot="label">
                            <i class="el-icon-user" />
                            {{ $t('interviewers') }}
                        </template>
                        <el-tooltip
                            v-for="interviewer in $get(interview, 'interviewers')"
                            :key="$get(interviewer, 'id')"
                        >
                            <div slot="content">
                                {{ $get(interviewer, 'user.name') }}<br>{{ $get(interviewer, 'user.email') }}
                            </div>
                            <el-avatar
                                class="cursor-pointer"
                                size="medium"
                                :src="`http://localhost:8000${$get(interviewer, 'user.profilePhotoUrl')}`"
                            />
                        </el-tooltip>
                    </el-descriptions-item>
                </el-descriptions>
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

    export default {
        components: {
            AllAssessments,
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
