<template>
    <div>
        <div>
            <nuxt-link to="/jobs/create">
                <el-button type="primary" class="capitalize">
                    <span class="material-icons mr-1">add</span>
                    {{ $t('create job') }}
                </el-button>
            </nuxt-link>
        </div>
        <JobList
            :jobs="jobs"
            :meta="meta"
        />
    </div>
</template>

<script>
    import JobList from '~/components/Job/List/index.vue';

    export default {
        name: 'JobPage',

        components: {
            JobList,
        },

        async asyncData({ $axios, query }) {
            const { data: jobs, meta } = await $axios.$get('jobs', { params: query });

            return {
                jobs,
                meta,
            };
        },

        data() {
            return {
                services: [],
                jobId: '',
                loading: false,
                countries: [],
                pipelines: [],
            };
        },

        watchQuery: true,

        methods: {
            // async deleteJob(jobId) {
            //     try {
            //         await deleteJob(jobId);
            //         this.jobs = this.jobs.filter((item) => item.id !== jobId);
            //         this.$message.success(this.$t('messages.delete_job'));
            //     } catch (error) {
            //         this.loading = false;
            //         this.$handleError(error);
            //     }
            // },
        },
    };
</script>
