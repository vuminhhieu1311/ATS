<template>
    <div class="-mt-10">
        <VueApexCharts
            type="radar"
            height="500"
            :options="chartOptions"
            :series="series"
        />
    </div>
</template>

<script>
    import _map from 'lodash/map';
    import VueApexCharts from 'vue-apexcharts';

    export default {
        components: {
            VueApexCharts,
        },

        props: {
            interview: {
                type: Object,
                required: true,
            },
        },

        data() {
            const criterionNames = _map(this.$get(this.interview, 'assessmentForm.criteria', []), ({ name }) => name);
            const criterionScores = _map(this.$get(this.interview, 'assessmentForm.criteria', []), ({ averageScore }) => averageScore);

            return {
                series: [{
                    name: 'Series 1',
                    data: criterionScores,
                }],
                chartOptions: {
                    chart: {
                        type: 'radar',
                        dropShadow: {
                            enabled: true,
                            blur: 1,
                            left: 1,
                            top: 1,
                        },
                        toolbar: {
                            show: false,
                        },
                    },
                    stroke: {
                        width: 2,
                    },
                    fill: {
                        opacity: 0.1,
                    },
                    xaxis: {
                        categories: criterionNames,
                    },
                    colors: ['#7367F0'],
                },
            };
        },

        watch: {
            interview(val) {
                const criterionScores = _map(this.$get(val, 'assessmentForm.criteria', []), ({ averageScore }) => averageScore);
                this.series = [{
                    name: 'Series 1',
                    data: criterionScores,
                }];
            },
        },
    };
</script>
