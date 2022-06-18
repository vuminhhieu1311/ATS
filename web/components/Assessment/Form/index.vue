<template>
    <div>
        <h3 class="title mb-8">{{ $t("create assessment form") }}</h3>
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
                <el-form-item :label="$t('criteria')">
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
                        v-for="(criteria, index) in addedCriteria"
                        :key="$get(criteria, 'id')"
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
                                    <p class="text font-semibold">{{ $get(criteria, 'name') }}</p>
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
                            <div>
                                <span
                                    class="cursor-pointer px-1 text-lg material-icons-outlined"
                                    @click="deleteCriterion($get(criteria, 'id'))"
                                >
                                    edit
                                </span>
                                <span
                                    class="cursor-pointer px-1 text-lg material-icons-outlined"
                                    @click="deleteCriterion($get(criteria, 'id'))"
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
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'CreateAssessmentForm',

        mixins: [formMixin, mixin],
    };
</script>
