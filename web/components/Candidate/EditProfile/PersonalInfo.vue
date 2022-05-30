<template>
    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
        <h5 class="my-5 text-xl font-semibold uppercase">
            {{ $t("candidate information") }}
        </h5>
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="top"
        >
            <el-form-item :label="$t('name')" prop="name">
                <el-input v-model="form.name" />
            </el-form-item>
            <el-row :gutter="20">
                <el-col :span="12">
                    <el-form-item :label="$t('email')" prop="email">
                        <el-input v-model="form.email" />
                    </el-form-item>
                </el-col>
                <el-col :span="12">
                    <el-form-item :label="$t('phone number')">
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
            <el-form-item :label="$t('address')">
                <el-input v-model="form.address" />
            </el-form-item>
            <el-form-item :label="$t('description')">
                <el-input v-model="form.description" type="textarea" :rows="4" />
            </el-form-item>
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
</template>

<script>
    import formMixin from '~/mixins/form';

    export default {
        mixins: [formMixin],

        data({ $auth, $get }) {
            const user = $auth.user;

            return {
                form: {
                    name: $get(user, 'name', null),
                    email: $get(user, 'email', null),
                    phoneNumber: $get(user, 'phone_number', null),
                    birthday: $get(user, 'birthday', null),
                    gender: $get(user, 'gender', null),
                    address: $get(user, 'address', null),
                    description: $get(user, 'candidate.description', null),
                },
                rules: {
                    name: 'required|type:string',
                    email: 'required|type:email',
                },
            };
        },

        methods: {
            resetForm() {
                this.$refs.form.resetFields();
            },
            async submitForm(formData) {
                const user = await this.$axios.$put('candidates/update-profile', {
                    ...formData,
                });
                this.$auth.setUser(user);
                this.$message.success(this.$t('update successfully'));
            },
        },
    };
</script>
