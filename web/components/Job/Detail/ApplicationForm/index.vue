<template>
    <div id="application-form" class="application-container bg-primary-gradient p-20 flex justify-center">
        <img src="@/assets/images/decore-left.png" class="decore-left" width="250">
        <img src="@/assets/images/decore-right.png" class="decore-right" width="250">
        <div class="w-3/4 lg:w-2/3 2xl:w-1/2 my-10">
            <el-card class="p-8 bg-white">
                <h1 class="text-4xl text-text font-semibold mb-10 text-center">{{ $t('apply for this job') }}</h1>
                <el-form
                    ref="form"
                    :model="form"
                    :rules="rules"
                    label-position="top"
                >
                    <el-form-item :label="$t('name')" prop="name">
                        <el-input
                            v-model="form.name"
                            :placeholder="$t('name')"
                        />
                    </el-form-item>
                    <el-form-item :label="$t('email')" prop="email">
                        <el-input
                            v-model="form.email"
                            :placeholder="$t('email')"
                        />
                    </el-form-item>
                    <el-form-item :label="$t('phone number')" prop="phone_number">
                        <el-input
                            v-model="form.phone_number"
                            :placeholder="$t('phone number')"
                        />
                    </el-form-item>
                    <el-form-item :label="$t('resume')" prop="resume">
                        <el-upload
                            ref="upload"
                            drag
                            :multiple="false"
                            :limit="2"
                            action="#"
                            :file-list="fileList"
                            :on-change="changeFileList"
                            :auto-upload="false"
                            :on-remove="removeFile"
                        >
                            <i class="el-icon-upload" />
                            <div class="el-upload__text">
                                {{ $t('drop file here or') }} <em>{{ $t('click to upload') }}</em>
                            </div>
                            <div slot="tip" class="el-upload__tip">{{ $t('resume file validation') }}</div>
                        </el-upload>
                    </el-form-item>
                    <div class="text-center">
                        <el-button
                            type="primary"
                            class="submit-btn uppercase w-full"
                            @click="submit($refs.form, submitForm)"
                        >
                            <p class="flex items-center text-2xl font-medium">
                                {{ $t('submit application') }}
                            </p>
                        </el-button>
                    </div>
                </el-form>
            </el-card>
        </div>
    </div>
</template>

<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'ApplicationForm',

        mixins: [formMixin, mixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
