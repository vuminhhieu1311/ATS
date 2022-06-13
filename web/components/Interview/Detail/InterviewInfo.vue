<template>
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
            <div class="flex items-center">
                <el-tag type="primary">
                    {{ interview.isOnline ? 'Online' : 'Offline' }}
                </el-tag>
            </div>
        </el-descriptions-item>
        <el-descriptions-item v-if="interview.isOnline">
            <template slot="label">
                <i class="el-icon-video-camera" />
                {{ $t('meeting') }}
            </template>
            <div class="flex items-center">
                <a
                    target="_blank"
                    :href="`/meeting/${$get(interview, 'id')}`"
                >
                    <el-button type="primary">
                        <span class="material-icons-outlined mr-2">videocam</span>
                        {{ $t('join meeting') }}
                    </el-button>
                </a>
            </div>
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
                {{ $t('candidate') }}
            </template>
            <a target="_blank" :href="`/candidates/${$get(interview, 'candidateJob.candidate.id')}`">
                <div class="flex justify-start">
                    <el-avatar
                        class="mr-2"
                        size="medium"
                        :src="`http://localhost:8000${$get(interview, 'candidateJob.candidate.user.profilePhotoUrl')}`"
                    />
                    <div>
                        <p class="text font-medium text-base">
                            {{ $get(interview, 'candidateJob.candidate.user.name') }}
                        </p>
                        <p class="text mt-1 text-sm">{{ $get(interview, 'candidateJob.candidate.user.email') }}</p>
                    </div>
                </div>
            </a>
        </el-descriptions-item>
        <el-descriptions-item>
            <template slot="label">
                <i class="el-icon-user" />
                {{ $t('scheduler') }}
            </template>
            <div class="flex justify-start">
                <el-avatar
                    class="mr-2"
                    size="medium"
                    :src="`http://localhost:8000${$get(interview, 'scheduler.user.profilePhotoUrl')}`"
                />
                <div>
                    <p class="text font-medium text-base">
                        {{ $get(interview, 'scheduler.user.name') }}
                    </p>
                    <p class="text mt-1 text-sm">{{ $get(interview, 'scheduler.user.email') }}</p>
                </div>
            </div>
        </el-descriptions-item>
        <el-descriptions-item>
            <template slot="label">
                <i class="el-icon-user" />
                {{ $t('interviewers') }}
            </template>
            <el-tooltip
                v-for="interviewer in $get(interview, 'interviewers')"
                :key="$get(interviewer, 'id')"
                class="mr-3"
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
        <el-descriptions-item>
            <template slot="label">
                <i class="el-icon-notebook-1" />
                {{ $t('note') }}
            </template>
            {{ $get(interview, 'note') }}
        </el-descriptions-item>
    </el-descriptions>
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

        methods: {
            time(time) {
                return moment(time).format('DD/MM/YYYY LT');
            },
        },
    };
</script>
