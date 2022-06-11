<template>
    <div class="bg-white border rounded p-5 pb-0 mb-5">
        <div class="flex justify-between items-center mb-5">
            <h1 class="title">{{ $t('filter jobs') }}</h1>
            <div class="flex justify-start">
                <div>
                    <el-button
                        type="primary"
                        class="capitalize"
                        @click="onSearchJobs"
                    >
                        {{ $t("search") }}
                    </el-button>
                </div>
                <div class="ml-4">
                    <el-button class="capitalize" type="info" @click="onClearFilter">
                        {{ $t("clear") }}
                    </el-button>
                </div>
            </div>
        </div>
        <el-form>
            <div class="flex">
                <el-form-item class="w-1/3">
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
                <el-form-item class="w-1/3 mx-5">
                    <el-input
                        v-model="name"
                        size="small"
                        clearable
                        :placeholder="$t('job name')"
                        @change="(val) => onChangeValue('name', val)"
                    />
                </el-form-item>
                <el-form-item class="w-1/3">
                    <el-input
                        v-model="location"
                        size="small"
                        clearable
                        :placeholder="$t('location')"
                        @change="(val) => onChangeValue('location', val)"
                    />
                </el-form-item>
            </div>
            <div class="flex">
                <el-form-item class="w-1/3">
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
                <el-form-item class="w-1/3 mx-5">
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
                <el-form-item class="w-1/3">
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
