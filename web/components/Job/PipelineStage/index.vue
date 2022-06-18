<template>
    <div>
        <el-form-item :label="$t('pipeline')" prop="pipelineId">
            <el-select
                :value="form.pipelineId"
                class="w-full"
                filterable
                clearable
                :placeholder="$t('pipeline')"
                @change="onChangePipeline"
            >
                <el-option
                    v-for="(item, index) in pipelines"
                    :key="index"
                    :label="$get(item, 'name')"
                    :value="$get(item, 'id')"
                />
            </el-select>
        </el-form-item>
        <div v-if="form.pipelineId" class="mb-3">
            <p class="mb-5">{{ $t('stages') }}:</p>
            <el-tag
                v-for="(stage, index) in $get(pipeline, 'stages')"
                :key="$get(stage, 'id')"
                class="w-full mb-5"
                type="primary"
            >
                {{ index + 1 }}. {{ $get(stage, 'name') }}
            </el-tag>
        </div>
    </div>
</template>

<script>
    import _find from 'lodash/find';

    export default {
        name: 'PipelineStage',

        props: {
            form: {
                type: Object,
                required: true,
            },
            pipelines: {
                type: Array,
                required: true,
            },
            onChangeValue: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                pipeline: _find(this.pipelines, ['id', this.form.pipelineId]),
            };
        },

        methods: {
            onChangePipeline(val) {
                this.pipeline = _find(this.pipelines, ['id', val]);
                this.onChangeValue('pipelineId', val);
            },
        },
    };
</script>
