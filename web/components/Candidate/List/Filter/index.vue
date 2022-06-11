<template>
    <div class="mt-3">
        <el-form>
            <div class="flex w-full">
                <el-form-item class="w-1/5">
                    <el-input
                        v-model="keyword"
                        clearable
                        :placeholder="$t('name/email/phone')"
                        @change="(val) => onChangeValue('keyword', val)"
                    />
                </el-form-item>
                <el-form-item class="w-1/5 mx-5">
                    <el-select
                        v-model="jobId"
                        class="w-full"
                        :placeholder="$t('job')"
                        filterable
                        clearable
                        @change="(val) => onChangeValue('jobId', val)"
                    >
                        <el-option
                            v-for="job in jobs"
                            :key="$get(job, 'id')"
                            :label="$get(job, 'name')"
                            :value="$get(job, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item class="w-1/5">
                    <el-select
                        v-model="pipelineId"
                        class="w-full"
                        :placeholder="$t('pipeline')"
                        filterable
                        clearable
                        @change="(val) => onChangeValue('pipelineId', val)"
                    >
                        <el-option
                            v-for="pipeline in pipelines"
                            :key="$get(pipeline, 'id')"
                            :label="$get(pipeline, 'name')"
                            :value="$get(pipeline, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item class="w-1/5 mx-5">
                    <el-select
                        v-model="stageId"
                        class="w-full"
                        :placeholder="$t('stage')"
                        filterable
                        clearable
                        @change="(val) => onChangeValue('stageId', val)"
                    >
                        <el-option
                            v-for="stage in stages"
                            :key="$get(stage, 'id')"
                            :label="$get(stage, 'name')"
                            :value="$get(stage, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item class="w-1/5 bg-white">
                    <el-checkbox
                        v-model="isStar"
                        class="w-full"
                        border
                        @change="(val) => onChangeValue('isStar', val)"
                    >
                        {{ $t('starred candidates') }}
                    </el-checkbox>
                </el-form-item>
            </div>
        </el-form>
    </div>
</template>

<script>
    import candidateMixin from './mixin';

    export default {
        name: 'CandidateFilter',

        mixins: [candidateMixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
