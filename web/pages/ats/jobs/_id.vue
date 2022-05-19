<template>
    <div class="w-full">
        <JobDetail :job="job" />
    </div>
</template>

<script>
    import JobDetail from '~/components/Job/Detail/index.vue';

    export default {
        components: {
            JobDetail,
        },

        layout: 'guest',

        async asyncData({ $axios, params }) {
            const { data: job } = await $axios.$get(`/jobs/published/${params.id}`);

            return { job };
        },
    };
</script>
