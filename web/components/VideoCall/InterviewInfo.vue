<template>
    <div>
        <div class="-mt-5 flex justify-start">
            <div>
                <el-avatar
                    :size="100"
                    :src="`http://localhost:8000${$get(interview, 'candidateJob.candidate.user.profilePhotoUrl')}`"
                    class="uppercase"
                />
            </div>
            <div class="ml-5">
                <p class="text font-medium text-xl">
                    {{ $get(interview, 'candidateJob.candidate.user.name') }}
                </p>
                <p class="text mt-1 text-sm">
                    {{ $get(interview, 'candidateJob.candidate.user.email') }}
                </p>
                <p class="text mt-1 text-sm">
                    {{ $get(interview, 'candidateJob.candidate.user.phoneNumber') }}
                </p>
                <el-rate
                    class="mt-1 mb-3"
                    :value="$get(interview, 'score', 0)"
                    disabled
                    show-score
                    text-color="#ff9900"
                    :score-template="`${$get(interview, 'score', 0)}/5`"
                />
                <nuxt-link class="view-detail" target="_blank" :to="`/interviews/${$get(interview, 'id')}`">
                    <el-button
                        type="primary"
                        size="mini"
                        class="capitalize"
                    >
                        <span class="text-base">{{ $t("view detail") }}</span>
                    </el-button>
                </nuxt-link>
            </div>
        </div>
        <el-descriptions class="mt-5" :column="1" border>
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
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
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

<style lang="scss">
    .view-detail {
        .el-button {
            padding: 5px 10px !important;
        }
    }
</style>
