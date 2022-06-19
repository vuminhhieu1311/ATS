<template>
    <el-dialog
        :visible.sync="show"
        :title="criterion ? $t('edit criterion') : $t('create new criterion')"
        width="50%"
        @close="close"
    >
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            size="medium"
        >
            <el-form-item :label="$t('name')" prop="name" :error="serverErrors.name">
                <el-input
                    v-model="form.name"
                    :placeholder="$t('name')"
                />
            </el-form-item>
            <el-form-item :label="$t('suggested questions')">
                <el-select
                    v-model="form.questionIds"
                    class="w-full"
                    multiple
                    filterable
                    :placeholder="$t('suggested questions')"
                >
                    <el-option
                        v-for="item in questions"
                        :key="$get(item, 'id')"
                        :label="$get(item, 'name')"
                        :value="$get(item, 'id')"
                    />
                </el-select>
            </el-form-item>
        </el-form>
        <span slot="footer">
            <el-button @click="resetForm">
                {{ $t('reset') }}
            </el-button>
            <el-button
                type="primary"
                :loading="processing"
                @click="submit($refs.form, submitForm)"
            >
                {{ $t('save changes') }}
            </el-button>
        </span>
    </el-dialog>
</template>
<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'CriterionForm',

        mixins: [formMixin, mixin],
    };
</script>

<style lang="scss">
    .el-select-dropdown {
        max-width: 500px;
    }
</style>
