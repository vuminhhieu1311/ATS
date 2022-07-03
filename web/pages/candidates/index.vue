<template>
    <div>
        <div class="flex justify-between">
            <h1 class="title">{{ $t('candidate list') }}</h1>
            <nuxt-link to="/candidates/create">
                <el-button type="primary" class="capitalize">
                    <span class="material-icons mr-1">add</span>
                    {{ $t('candidate') }}
                </el-button>
            </nuxt-link>
        </div>
        <CandidateFilter />
        <CandidateList
            :candidates="candidates"
            :meta="meta"
            :star-candidate="starCandidate"
        />
    </div>
</template>

<script>
    import _map from 'lodash/map';
    import CandidateList from '~/components/Candidate/List/index.vue';
    import CandidateFilter from '~/components/Candidate/List/Filter/index.vue';
    import { MANAGE_CANDIDATE } from '~/enums/permission';

    export default {
        name: 'CandidatesPage',

        components: {
            CandidateList,
            CandidateFilter,
        },

        middleware: 'permission',

        meta: {
            permissions: [MANAGE_CANDIDATE],
        },

        async asyncData({ $axios, query }) {
            const { data: candidates, meta } = await $axios.$get('candidates', { params: query });

            return {
                candidates,
                meta,
            };
        },

        watchQuery: true,

        methods: {
            async starCandidate(candidateId) {
                try {
                    const { data: candidate } = await this.$axios.$get(`candidates/${candidateId}/star`);

                    this.candidates = _map(this.candidates, (item) => {
                        if (item.id === candidateId) {
                            item.isStar = candidate.isStar;
                        }

                        return item;
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
