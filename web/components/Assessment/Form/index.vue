<template>
    <div>
        <h3 class="title mb-8">{{ assessmentForm ? $t("edit assessment form") : $t("create assessment form") }}</h3>
        <div class="bg-white p-8 mt-8 rounded-md">
            <el-form
                ref="form"
                :model="form"
                :rules="formRules"
                label-position="top"
            >
                <el-form-item :label="$t('name')" prop="name">
                    <el-input v-model="form.name" />
                </el-form-item>
                <div class="flex justify-between items-center mb-5">
                    <p>{{ $t("criteria") }}</p>
                    <el-button
                        type="primary"
                        class="capitalize criterion-btn"
                        @click="openCreateCriterionForm"
                    >
                        <span class="text-base material-icons mr-1">add_circle</span>
                        {{ $t('new criterion') }}
                    </el-button>
                </div>
                <el-form-item>
                    <el-select
                        v-model="form.criterionIds"
                        class="w-full"
                        multiple
                        collapse-tags
                        filterable
                        placeholder="Select"
                    >
                        <el-option
                            v-for="item in criteria"
                            :key="$get(item, 'id')"
                            :label="$get(item, 'name')"
                            :value="$get(item, 'id')"
                        />
                    </el-select>
                </el-form-item>
                <el-row :gutter="20">
                    <el-col
                        v-for="(criterion, index) in addedCriteria"
                        :key="$get(criterion, 'id')"
                        :xl="8"
                        :lg="8"
                        :md="12"
                        :sm="24"
                        :xs="24"
                    >
                        <div class="staff-card shadow-md border flex justify-between mb-8 p-3 rounded-md">
                            <div class="flex justify-start">
                                <div>
                                    <el-avatar size="small" class="uppercase font-semibold">{{ index + 1 }}</el-avatar>
                                </div>
                                <div class="info ml-2">
                                    <p class="text font-semibold mr-2">{{ $get(criterion, 'name') }}</p>
                                    <div class="flex mt-2">
                                        <p class="mr-5">{{ $t('weight') }}:</p>
                                        <el-input-number
                                            v-model="form.weights[index]"
                                            size="mini"
                                            :min="1"
                                            :max="10"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="flex">
                                <span
                                    class="cursor-pointer px-1 text-lg material-icons-outlined"
                                    @click="openEditCriterionForm(criterion)"
                                >
                                    edit
                                </span>
                                <span
                                    class="cursor-pointer px-1 text-lg material-icons-outlined"
                                    @click="deleteCriterion($get(criterion, 'id'))"
                                >
                                    close
                                </span>
                            </div>
                        </div>
                    </el-col>
                </el-row>
                <div class="flex justify-start pt-3">
                    <el-button type="primary" class="capitalize" @click="submit($refs.form, submitForm)">
                        {{ $t("save changes") }}
                    </el-button>
                    <div class="ml-5">
                        <el-button
                            type="info"
                            plain
                            class="capitalize"
                            @click="resetForm"
                        >
                            {{ $t("reset") }}
                        </el-button>
                    </div>
                </div>
            </el-form>
        </div>
        <CriterionForm
            ref="createCriterionForm"
            :submit-form="createCriterion"
        />
        <CriterionForm
            ref="editCriterionForm"
            :submit-form="updateCriterion"
        />
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import CriterionForm from '~/components/Criterion/Form/index.vue';
    import mixin from './mixin';

    export default {
        name: 'AssessmentForm',

        components: {
            CriterionForm,
        },

        mixins: [formMixin, mixin],
    };
</script>

<style lang="scss">
    .criterion-btn {
        padding: 8px 10px !important;
    }
</style>
