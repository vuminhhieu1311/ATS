<template>
    <div>
        <div class="flex flex-wrap">
            <div class="w-full lg:w-1/2 mb-base mb-8 lg:pr-8">
                <el-card
                    :body-style="{ padding: '0px' }"
                    class="welcome-card application-container text-center bg-primary-gradient"
                >
                    <img src="@/assets/images/decore-left.png" class="decore-left" width="175">
                    <img src="@/assets/images/decore-right.png" class="decore-right" width="175">
                    <span
                        class="material-icons-outlined px-7 py-6 mb-10 bg-primary inline-flex
                        rounded-full text-4xl text-white shadow mt-10"
                    >
                        workspace_premium
                    </span>
                    <p class="mb-3 text-white text-xl font-semibold">{{ $t('hello') }} {{ $auth.user.name }},</p>
                    <p class="text-white text-xl">{{ $t('welcome to') }} ATS System</p>
                </el-card>
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base lg:pr-4">
                <JobStatistics />
            </div>
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/4 xl:w-1/4 mb-base lg:pl-4">
                <InterviewStatistics />
            </div>
        </div>

        <el-card class="bg-white">
            <p class="title">{{ $t('candidates') }}</p>
            <VueApexCharts
                type="bar"
                height="500"
                :options="chartOptions"
                :series="series"
            />
        </el-card>
    </div>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts';
    import JobStatistics from './JobStatistics.vue';
    import InterviewStatistics from './InterviewStatistics.vue';

    export default {
        name: 'StatisticalReport',

        components: {
            VueApexCharts,
            JobStatistics,
            InterviewStatistics,
        },

        props: {
            candidateCounts: {
                type: Array,
                required: true,
            },
        },

        data() {
            return {
                series: [
                    {
                        data: this.candidateCounts,
                    },
                ],
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'bar',
                        events: {
                            // click: function (chart, w, e) {
                            //     // console.log(chart, w, e)
                            // },
                        },
                    },
                    colors: ['#7367F0', '#FFD291'],
                    plotOptions: {
                        bar: {
                            columnWidth: '45%',
                            distributed: true,
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: false,
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
                        labels: {
                            style: {
                                fontSize: '12px',
                            },
                        },
                    },
                },
            };
        },
    };
</script>

<style lang="scss" scoped>
    .welcome-card {
        height: 278px;
    }
</style>
