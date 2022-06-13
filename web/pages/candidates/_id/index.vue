<template>
    <div class="w-full">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-8/12 pr-8">
                <CardDetail :candidate="candidate" :update-candidate="updateCandidate" />
            </div>
            <div class="w-full lg:w-4/12">
                <CardSummary :candidate="candidate" />
            </div>
        </div>
    </div>
</template>

<script>
    import CardDetail from '~/components/Candidate/Detail/CardDetail/index.vue';
    import CardSummary from '~/components/Candidate/Detail/CardSummary/index.vue';

    export default {
        name: 'CandidateDetailPage',

        components: {
            CardDetail,
            CardSummary,
        },

        async asyncData({ $axios, params }) {
            const { data: candidate } = await $axios.$get(`candidates/${params.id}`);

            return { candidate };
        },

        methods: {
            async updateCandidate(formData) {
                const { data: candidate } = await this.$axios.$put(`candidates/${this.$get(this.candidate, 'id')}`, formData);
                this.candidate = candidate;
                this.$message.success(this.$t('update successfully'));
            },
        },
    };
</script>
