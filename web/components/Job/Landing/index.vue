<template>
    <div class="grid grid-cols-10 gap-10 my-10 mx-10">
        <div class="col-span-3">
            <JobFilter
                :query="query"
                :update-query="updateQuery"
                :update-job-list="updateJobList"
                :fetch-jobs="fetchJobs"
            />
        </div>
        <div class="col-span-7">
            <div class="flex items-center mb-5">
                <el-input
                    v-model="name"
                    class="mr-5"
                    prefix-icon="el-icon-search"
                    :placeholder="$t('name')"
                    clearable
                />
                <el-button
                    type="primary"
                    class="search-filter capitalize"
                    @click="onSearchJobs"
                >
                    <span class="material-icons mr-1">search</span>
                    {{ $t("search") }}
                </el-button>
            </div>
            <JobCard
                v-for="(job, index) in jobs"
                :key="index"
                :job="job"
                @click.native="$router.push(`landing/${$get(job, 'id')}`)"
            />
        </div>
    </div>
</template>
<script>
    import mixin from './mixin';
    import JobCard from './JobCard.vue';
    import JobFilter from './Filter/index.vue';

    export default {
        name: 'JobLanding',

        components: {
            JobCard,
            JobFilter,
        },

        mixins: [mixin],
    };
</script>

<style lang="scss">
    .el-loading-mask {
        .el-loading-spinner {
            top: 350px;
        }
    }
</style>
