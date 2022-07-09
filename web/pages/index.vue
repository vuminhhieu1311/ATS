<template>
    <div>
        <Report :candidate-counts="candidateCounts" />
    </div>
</template>

<script>
    import Report from '~/components/Report/index.vue';

    export default {
        name: 'DashboardPage',

        components: {
            Report,
        },

        async asyncData({ $axios }) {
            const candidateCounts = await $axios.$get('candidates/count-by-months');

            return {
                candidateCounts,
            };
        },
    };
</script>
