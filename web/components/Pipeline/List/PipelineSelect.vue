<template>
    <el-select
        v-model="pipelineId"
        size="small"
        @change="onChangePipeline"
    >
        <el-option
            v-for="item in pipelines"
            :key="item.id"
            :label="item.name"
            :value="item.id"
        />
    </el-select>
</template>
<script>
    export default {
        props: {
            pipelines: {
                type: Array,
                default() {
                    return [];
                },
            },
            pipeline: {
                type: Object,
                default() {
                    return {};
                },
            },
            onChangePipeline: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                pipelineId: this.$get(this.pipeline, 'id'),
            };
        },
    };
</script>
