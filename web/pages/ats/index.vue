<template>
    <div
        v-infinite-scroll="loadMore"
        :infinite-scroll-disabled="loading"
        class="w-full h-screen overflow-auto"
    >
        <el-carousel height="300px">
            <el-carousel-item v-for="item in 2" :key="item">
                <el-image
                    style="height: 300px"
                    :src="require(`~/assets/images/banner${item}.png`)"
                    fit="fill"
                />
            </el-carousel-item>
        </el-carousel>
        <JobLanding
            :jobs="$get(jobs, 'data', [])"
            :loading="loading"
            :query="query"
            :fetch-jobs="fetchJobs"
            :update-job-list="updateJobList"
            :update-query="updateQuery"
        />
    </div>
</template>

<script>
    import _concat from 'lodash/concat';
    import JobLanding from '~/components/Job/Landing/index.vue';

    export default {
        name: 'AtsLanding',

        components: {
            JobLanding,
        },

        layout: 'candidate',

        async asyncData({ $axios }) {
            const jobs = await $axios.$get('jobs/published');

            return {
                jobs,
            };
        },

        data() {
            return {
                loading: false,
                query: {},
            };
        },

        methods: {
            async fetchJobs() {
                try {
                    this.loading = true;
                    const { data: jobs, meta } = await this.$axios.$get('jobs/published', {
                        params: {
                            ...this.query,
                            page: this.$get(this.jobs, 'meta.currentPage', 0) + 1,
                        },
                    });
                    this.jobs.data = _concat(this.$get(this.jobs, 'data', []), jobs);
                    this.jobs.meta = meta;
                } catch (error) {
                    this.$handleError(error);
                } finally {
                    this.loading = false;
                }
            },
            loadMore() {
                if (this.jobs.meta.currentPage !== this.jobs.meta.lastPage) {
                    this.fetchJobs();
                }
            },
            updateJobList(jobs) {
                this.jobs = jobs;
            },
            updateQuery(query) {
                this.query = query;
            },
        },
    };
</script>

<style>
    .el-carousel__item,
    .el-image__inner {
        background-color: white;
        height: 300px;
        width: 100vw;
    }
    .el-carousel__indicators {
        display: none;
    }
</style>
