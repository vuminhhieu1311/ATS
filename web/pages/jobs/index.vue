<template>
    <div>
        <div class="flex justify-between">
            <h1 class="title">{{ $t('job list') }}</h1>
            <nuxt-link to="/jobs/create">
                <el-button type="primary" class="capitalize">
                    <span class="material-icons mr-1">add</span>
                    {{ $t('create job') }}
                </el-button>
            </nuxt-link>
        </div>
        <JobFilter />
        <JobList
            :jobs="jobs"
            :meta="meta"
            :delete-job="deleteJob"
        />
    </div>
</template>

<script>
    import JobList from '~/components/Job/List/index.vue';
    import JobFilter from '~/components/Job/List/Filter/index.vue';

    export default {
        name: 'JobsPage',

        components: {
            JobList,
            JobFilter,
        },

        async asyncData({ $axios, query }) {
            const { data: jobs, meta } = await $axios.$get('jobs', { params: query });

            return {
                jobs,
                meta,
            };
        },

        watchQuery: true,

        methods: {
            deleteJob(jobId) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete job'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        await this.$axios.$delete(`jobs/${jobId}`);
                        this.jobs = this.jobs.filter((item) => item.id !== jobId);
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
