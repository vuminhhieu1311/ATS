<template>
    <el-card :body-style="{ padding: '0px' }">
        <div class="p-5">
            <span
                class="material-icons-outlined p-4 mb-3 bg-lightPrimary inline-flex rounded-full text-primary shadow"
            >
                workspace_premium
            </span>
            <p class="text-text mb-2 text-4xl font-semibold">968</p>
            <p class="text-text text-lg">{{ $t('jobs') }}</p>
        </div>
        <VueApexCharts
            type="area"
            height="100"
            width="100%"
            :options="chartOptions"
            :series="series"
        />
    </el-card>
</template>

<script>
    import VueApexCharts from 'vue-apexcharts';

    export default {
        name: 'StatisticalReport',

        components: {
            VueApexCharts,
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
                        name: this.$t('jobs'),
                        data: [28, 40, 36, 52, 38, 60, 55],
                    },
                ],
                chartOptions: {
                    grid: {
                        show: false,
                        padding: {
                            left: 0,
                            right: 0,
                        },
                    },
                    chart: {
                        toolbar: {
                            show: false,
                        },
                        sparkline: {
                            enabled: true,
                        },
                    },
                    colors: ['#7367F0'],
                    dataLabels: {
                        enabled: false,
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2.5,
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 0.9,
                            opacityFrom: 0.7,
                            opacityTo: 0.5,
                            stops: [0, 80, 100],
                        },
                    },
                    xaxis: {
                        type: 'numeric',
                        lines: {
                            show: false,
                        },
                        axisBorder: {
                            show: false,
                        },
                        labels: { show: false },
                    },
                    yaxis: [
                        {
                            y: 0,
                            offsetX: 0,
                            offsetY: 0,
                            padding: {
                                left: 0,
                                right: 0,
                            },
                        },
                    ],
                    tooltip: {
                        x: { show: false },
                    },
                },
            };
        },
    };
</script>
