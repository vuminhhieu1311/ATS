<template>
    <div class="-mt-5">
        <h3 class="title mb-5">{{ $t("assessment form") }}</h3>
        <el-form
            ref="form"
            :model="form"
        >
            <el-collapse v-model="activeNames">
                <el-collapse-item
                    v-for="(criterion, index) in $get(interview, 'assessmentForm.criteria', [])"
                    :key="$get(criterion, 'id')"
                    :title="$get(criterion, 'name')"
                    :name="$get(criterion, 'id')"
                >
                    <el-rate
                        v-model="form.rates[index]"
                        :colors="colors"
                        :texts="[$t('poor'), $t('fair'), $t('good'), $t('very good'), $t('excellent')]"
                        show-text
                    />
                    <el-input
                        v-model="form.notes[index]"
                        class="mt-5"
                        type="textarea"
                        :placeholder="$t('comment')"
                    />
                </el-collapse-item>
            </el-collapse>
        </el-form>
        <div class="mt-5">
            <el-button
                class="w-full"
                type="primary"
                :loading="processing"
                @click="submit($refs.form, submitAssessmentForm)"
            >
                {{ $t('submit') }}
            </el-button>
        </div>
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'AssessmentForm',

        mixins: [formMixin, mixin],
    };
</script>
