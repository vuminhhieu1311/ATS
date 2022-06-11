<template>
    <div class="flex items-center w-full">
        <div>
            <el-input
                v-model="candidate"
                :placeholder="$t('name/email/phone')"
                clearable
                size="small"
                @input="(val) => onChangeValue('candidate', val)"
            />
        </div>
        <el-checkbox
            v-model="isStar"
            class="ml-4 bg-white"
            border
            size="small"
            @change="(val) => onChangeValue('isStar', val)"
        >
            {{ $t('starred candidates') }}
        </el-checkbox>
        <JobSelect
            :jobs="jobs"
            :job-id="jobId"
            :on-change-job="onChangeJob"
        />
        <PipelineSelect
            :pipeline="pipeline"
            :pipelines="pipelines"
            :on-change-pipeline="onChangePipeline"
        />
    </div>
</template>
<script>
    import PipelineSelect from '~/components/Pipeline/List/PipelineSelect.vue';
    import JobSelect from '~/components/Pipeline/List/JobSelect.vue';
    import mixin from './mixin';

    export default {
        name: 'PipelineFilter',

        components: {
            PipelineSelect,
            JobSelect,
        },

        mixins: [mixin],
    };
</script>
