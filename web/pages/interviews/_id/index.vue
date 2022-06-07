<template>
    <div class="w-full">
        <InterviewDetail
            :interview="interview"
            :update-interview="updateInterview"
        />
    </div>
</template>

<script>
    import InterviewDetail from '~/components/Interview/Detail/index.vue';

    export default {
        name: 'InterviewDetailPage',

        components: {
            InterviewDetail,
        },

        async asyncData({ $axios, params }) {
            const [
                { data: interview },
            ] = await Promise.all([
                $axios.$get(`/interviews/${params.id}`),
            ]);

            return {
                interview,
            };
        },

        methods: {
            updateInterview(interview) {
                this.interview = interview;
            },
        },
    };
</script>
