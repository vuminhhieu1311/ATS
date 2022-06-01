<template>
    <div>
        <h3 class="title mb-8">{{ $t("create pipeline") }}</h3>
        <div class="bg-white p-8 mt-8 rounded-md">
            <el-form
                ref="form"
                :model="form"
                :rules="formRules"
                label-width="18%"
                label-position="left"
            >
                <el-form-item :label="$t('pipeline name')" prop="name" :error="serverErrors.name">
                    <el-input
                        v-model="form.name"
                        :placeholder="$t('pipeline name')"
                    />
                </el-form-item>
                <el-form-item :label="$t('pipeline jobs')" prop="jobs">
                    <el-select
                        v-model="form.jobIds"
                        multiple
                        filterable
                        remote
                        :remote-method="onSearchJobs"
                        :placeholder="$t('job name')"
                        class="w-full"
                    >
                        <el-option
                            v-for="job in jobs"
                            :key="$_get(job, 'id')"
                            :label="$_get(job, 'name')"
                            :value="$_get(job, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <div class="flex justify-between items-center mb-2">
                    <p class="mb-8 mt-3">{{ $t("pipeline stages") }}</p>
                    <el-button
                        type="primary"
                        class="capitalize add-btn"
                        @click="onOpenCreateStageForm"
                    >
                        <span class="text-base material-icons mr-1">add_circle</span>
                        {{ $t('new stage') }}
                    </el-button>
                </div>
                <DraggableList
                    :list1="allStages"
                    :list2="addedStages"
                    @addStage="addStage"
                    @removeStage="removeStage"
                    @addAllStages="addAllStages"
                />
                <div class="flex justify-end mt-6">
                    <div class="mr-5">
                        <el-button
                            class="capitalize"
                            @click="resetForm"
                        >
                            {{ $t('reset') }}
                        </el-button>
                    </div>
                    <el-button
                        type="primary"
                        class="capitalize"
                        :loading="loading"
                        @click="onCreatePipeline"
                    >
                        {{ $t('save changes') }}
                    </el-button>
                </div>
            </el-form>
        </div>
        <CreateStageForm ref="createStageForm" @addNewStage="addNewStage" />
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';
    import DraggableList from '../../Stage/DraggableList.vue';
    // import CreateStageForm from '../../Stage/Basic/index.vue';

    export default {
        name: 'CreateForm',

        components: {
            DraggableList,
            // CreateStageForm,
        },

        mixins: [formMixin, mixin],
    };
</script>

<style lang="scss" scoped>
    .add-btn {
        padding: 8px 10px !important;
        font-size: theme('fontSize.base') !important;
    }
</style>
