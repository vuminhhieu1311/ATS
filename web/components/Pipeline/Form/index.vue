<template>
    <div>
        <h3 class="title mb-8">{{ $t("create pipeline") }}</h3>
        <div class="bg-white p-8 mt-8 rounded-md">
            <el-form
                ref="form"
                :model="form"
                :rules="formRules"
                label-position="top"
            >
                <el-form-item :label="$t('pipeline name')" prop="name" :error="serverErrors.name">
                    <el-input
                        v-model="form.name"
                        :placeholder="$t('pipeline name')"
                    />
                </el-form-item>
                <el-form-item :label="$t('pipeline jobs')" prop="jobIds" :error="serverErrors.jobIds">
                    <el-select
                        v-model="form.jobIds"
                        multiple
                        filterable
                        collapse-tags
                        remote
                        :remote-method="onSearchJobs"
                        :placeholder="$t('job name')"
                        class="w-full"
                    >
                        <el-option
                            v-for="job in jobs"
                            :key="$get(job, 'id')"
                            :label="$get(job, 'name')"
                            :value="$get(job, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-row :gutter="20">
                    <el-col
                        v-for="job in addedJobs"
                        :key="$get(job, 'id')"
                        :xl="8"
                        :lg="8"
                        :md="12"
                        :sm="24"
                        :xs="24"
                    >
                        <div class="staff-card shadow-md border flex justify-between mb-8 p-3 rounded-md">
                            <div class="flex justify-start">
                                <div>
                                    <el-avatar size="large" :src="require('~/assets/images/logo-icon.png')" />
                                </div>
                                <div class="info ml-2">
                                    <p class="text font-semibold text-lg">{{ $get(job, 'name') }}</p>
                                    <p class="text">{{ $get(job, 'city') }}</p>
                                </div>
                            </div>
                            <span
                                class="cursor-pointer px-1 text-base material-icons-outlined"
                                @click="deleteJob($get(job, 'id'))"
                            >
                                close
                            </span>
                        </div>
                    </el-col>
                </el-row>
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
                        :loading="processing"
                        @click="onSubmitForm"
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
    import CreateStageForm from '../../Stage/Form/index.vue';

    export default {
        name: 'CreateForm',

        components: {
            DraggableList,
            CreateStageForm,
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
