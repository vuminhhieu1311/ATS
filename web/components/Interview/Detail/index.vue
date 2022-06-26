<template>
    <div class="flex flex-wrap">
        <div class="w-full lg:w-8/12 pr-8">
            <div class="bg-white p-8 flex justify-start">
                <div>
                    <vue-avatar
                        :username="$get(interview, 'candidateJob.candidate.user.name')"
                        :src="`http://localhost:8000${$get(interview, 'candidateJob.candidate.user.profilePhotoUrl')}`"
                        :size="120"
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
                        class="mt-1"
                        :value="$get(interview, 'score', 0)"
                        disabled
                        show-score
                        text-color="#ff9900"
                        :score-template="`${$get(interview, 'score', 0)}/5`"
                    />
                </div>
            </div>
            <InterviewTabs :interview="interview" />
        </div>
        <div class="w-full bg-white p-8 lg:w-4/12">
            <AssessmentForm
                :interview="interview"
                @updateInterview="updateInterview"
            />
        </div>
    </div>
</template>

<script>
    import AssessmentForm from '~/components/Assessment/index.vue';
    import InterviewTabs from './InterviewTabs.vue';

    export default {
        name: 'InterviewDetail',

        components: {
            InterviewTabs,
            AssessmentForm,
        },

        props: {
            interview: {
                type: Object,
                required: true,
            },
            updateInterview: {
                type: Function,
                required: true,
            },
        },
    };
</script>
