<template>
    <div class="mt-3">
        <el-form>
            <div class="flex">
                <el-form-item class="w-1/6">
                    <el-select
                        v-model="pipelineId"
                        class="w-full"
                        size="small"
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
                <el-form-item class="w-1/6 mx-5">
                    <el-input
                        v-model="name"
                        size="small"
                        clearable
                        :placeholder="$t('job name')"
                        @input="(val) => onChangeValue('name', val)"
                    />
                </el-form-item>
                <el-form-item class="w-1/6">
                    <el-input
                        v-model="location"
                        size="small"
                        clearable
                        :placeholder="$t('location')"
                        @input="(val) => onChangeValue('location', val)"
                    />
                </el-form-item>
                <el-form-item class="w-1/6 mx-5">
                    <el-select
                        v-model="tag"
                        size="small"
                        class="w-full"
                        :placeholder="$t('job tag')"
                        filterable
                        clearable
                        remote
                        :remote-method="onSearchJobTag"
                        @change="(val) => onChangeValue('tag', val)"
                    >
                        <el-option
                            v-for="tag in tags"
                            :key="$get(tag, 'id')"
                            :label="$get(tag, 'name')"
                            :value="$get(tag, 'name')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item class="w-1/6 mr-5">
                    <el-select
                        v-model="type"
                        size="small"
                        class="w-full"
                        :placeholder="$t('employment type')"
                        filterable
                        clearable
                        @change="(val) => onChangeValue('type', val)"
                    >
                        <el-option
                            v-for="item in types"
                            :key="item"
                            :label="item"
                            :value="item"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item class="w-1/6">
                    <el-select
                        v-model="status"
                        size="small"
                        class="w-full"
                        :placeholder="$t('job status')"
                        filterable
                        clearable
                        @change="(val) => onChangeValue('status', val)"
                    >
                        <el-option
                            v-for="item in statuses"
                            :key="item"
                            :label="item"
                            :value="item"
                        />
                    </el-select>
                </el-form-item>
            </div>
        </el-form>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        name: 'JobFilter',

        mixins: [mixin],
    };
</script>
