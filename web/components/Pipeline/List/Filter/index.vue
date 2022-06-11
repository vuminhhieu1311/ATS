<template>
    <div class="flex items-center w-full">
        <PipelineSelect
            :pipeline="pipeline"
            :pipelines="pipelines"
            :on-change-pipeline="onChangePipeline"
        />
        <JobSelect
            :jobs="jobs"
            :job-id="jobId"
            :on-change-job="onChangeJob"
        />
        <div>
            <el-input
                v-model="candidate"
                :placeholder="$t('name/email/phone')"
                clearable
                @input="(val) => onChangeValue('candidate', val)"
            />
        </div>
        <el-checkbox
            v-model="isStar"
            class="ml-4"
            @change="(val) => onChangeValue('isStar', val)"
        >
            {{ $t('starred candidates') }}
        </el-checkbox>
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
