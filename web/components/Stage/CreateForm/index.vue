<template>
    <el-dialog
        :visible.sync="show"
        :title="$t('add new stage')"
        width="50%"
        @close="close"
    >
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            size="medium"
        >
            <el-form-item :label="$t('stage name')" prop="name" :error="serverErrors.name">
                <el-input
                    v-model="form.name"
                    :placeholder="$t('stage name')"
                />
            </el-form-item>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <el-button @click="resetForm">
                {{ $t('reset') }}
            </el-button>
            <el-button
                type="primary"
                :loading="loading"
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
        name: 'StageForm',

        mixins: [formMixin, mixin],
    };
</script>
