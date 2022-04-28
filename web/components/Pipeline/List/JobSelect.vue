<template>
    <el-select
        v-model="id"
        class="mr-4"
        filterable
        @change="onChangeJob"
    >
        <el-option
            :label="$t('all jobs')"
            :value="0"
        />
        <el-option
            v-for="item in jobs"
            :key="item.id"
            :label="item.name"
            :value="item.id"
        />
    </el-select>
</template>
<script>
    import _cloneDeep from 'lodash/cloneDeep';

    export default {
        props: {
            jobs: {
                type: Array,
                default() {
                    return [];
                },
            },
            jobId: {
                type: Number,
                default: 0,
            },
            onChangeJob: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                id: _cloneDeep(this.jobId),
            };
        },

        watch: {
            jobId(val) {
                this.id = val;
            },
        },
    };
</script>
