<template>
    <div>
        <div>
            <nuxt-link to="/candidates/create">
                <el-button type="primary" class="capitalize">
                    <span class="material-icons mr-1">add</span>
                    {{ $t('candidate') }}
                </el-button>
            </nuxt-link>
        </div>
        <CandidateList
            :candidates="candidates"
            :meta="meta"
        />
    </div>
</template>

<script>
    import CandidateList from '~/components/Candidate/List/index.vue';

    export default {
        name: 'CandidatesPage',

        components: {
            CandidateList,
        },

        async asyncData({ $axios, query }) {
            const { data: candidates, meta } = await $axios.$get('candidates', { params: query });

            return {
                candidates,
                meta,
            };
        },

        watchQuery: true,
    };
</script>
