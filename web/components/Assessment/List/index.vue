<template>
    <div>
        <div class="flex justify-between mb-8">
            <nuxt-link to="/assessment-forms/create">
                <el-button type="primary" class="capitalize">
                    <span class="material-icons mr-1">add</span>
                    {{ $t('assessment form') }}
                </el-button>
            </nuxt-link>
            <div class="flex justify-end">
                <el-input
                    v-model="name"
                    class="mr-5"
                    :placeholder="$t('name')"
                    clearable
                    @input="(val) => onChangeValue('name', val)"
                />
                <el-date-picker
                    v-model="createdAt"
                    type="date"
                    value-format="yyyy-MM-dd"
                    format="dd/MM/yyyy"
                    :placeholder="$t('creation date')"
                    @input="(val) => onChangeValue('createdAt', val)"
                />
            </div>
        </div>
        <el-row :gutter="40">
            <el-col
                v-for="assessmentForm in assessmentForms"
                :key="$get(assessmentForm, 'id')"
                :span="12"
                class="mb-10"
            >
                <el-card>
                    <div class="text-lg text-text font-semibold mb-5">{{ $get(assessmentForm, 'name') }}</div>
                    <el-tag
                        v-for="(criterion, index) in $get(assessmentForm, 'criteria')"
                        :key="$get(criterion, 'id')"
                        class="w-full mb-3"
                        type="primary"
                    >
                        {{ index + 1 }}. {{ $get(criterion, 'name') }}
                    </el-tag>
                    <div class="flex justify-end mt-2">
                        <nuxt-link
                            :to="`/assessment-forms/${$get(assessmentForm, 'id')}/edit`"
                            class="mr-5"
                        >
                            <el-button
                                plain
                                size="small"
                                icon="el-icon-edit"
                                class="editBtn"
                            >
                                {{ $t('edit') }}
                            </el-button>
                        </nuxt-link>
                        <el-button
                            type="primary"
                            size="small"
                            icon="el-icon-delete"
                            class="deleteBtn"
                            @click="deleteAssessmentForm($get(assessmentForm, 'id'))"
                        >
                            {{ $t('delete') }}
                        </el-button>
                    </div>
                </el-card>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        name: 'AssessmentFormList',

        mixins: [mixin],
    };
</script>
