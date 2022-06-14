<template>
    <div class="flex-auto">
        <h5 class="mb-5 font-bold uppercase">
            {{ $t("candidate information") }}
        </h5>
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="top"
        >
            <el-form-item :label="$t('name')" prop="name" :error="serverErrors.name">
                <el-input v-model="form.name" />
            </el-form-item>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-form-item :label="$t('email')" prop="email" :error="serverErrors.email">
                        <el-input v-model="form.email" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item :label="$t('phone number')" :error="serverErrors.phoneNumber">
                        <el-input v-model="form.phoneNumber" />
                    </el-form-item>
                </el-col>
            </el-row>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-form-item :label="$t('birthday')">
                        <el-date-picker
                            v-model="form.birthday"
                            value-format="yyyy-MM-dd"
                            format="dd/MM/yyyy"
                            type="date"
                        />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item :label="$t('gender')">
                        <el-radio-group v-model="form.gender">
                            <el-radio-button label="male">{{ $t('male') }}</el-radio-button>
                            <el-radio-button label="female">{{ $t('female') }}</el-radio-button>
                        </el-radio-group>
                    </el-form-item>
                </el-col>
            </el-row>
            <el-form-item :label="$t('address')" prop="address" :error="serverErrors.address">
                <el-input v-model="form.address" />
            </el-form-item>
            <el-form-item :label="$t('description')" prop="description" :error="serverErrors.description">
                <el-input v-model="form.description" type="textarea" :rows="4" />
            </el-form-item>
            <div class="flex justify-start pt-3">
                <el-button type="primary" class="capitalize" @click="submit($refs.form, submitForm)">
                    {{ $t("save changes") }}
                </el-button>
                <el-button
                    class="capitalize"
                    @click="resetForm"
                >
                    {{ $t("reset") }}
                </el-button>
            </div>
        </el-form>
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'BasicInfo',

        mixins: [formMixin, mixin],
    };
</script>
