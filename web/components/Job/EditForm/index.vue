<template>
    <div class="vertical-tabs">
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            label-position="top"
        >
            <el-tabs
                type="card"
                tab-position="left"
                class="w-full rounded-lg border-0"
            >
                <el-tab-pane :label="$t('details')">
                    <el-form-item :label="$t('name')" prop="name" :error="serverErrors.name">
                        <el-input v-model="form.name" :placeholder="$t('name')" />
                    </el-form-item>
                    <el-form-item :label="$t('country')" prop="country">
                        <el-select
                            v-model="form.country"
                            class="w-full"
                            filterable
                            clearable
                            :placeholder="$t('country')"
                            @change="getCitiesByCountry"
                        >
                            <el-option
                                v-for="(country, index) in countries"
                                :key="index"
                                :label="$get(country, 'country')"
                                :value="$get(country, 'country')"
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item :label="$t('city')" prop="city" :error="serverErrors.city">
                        <el-select
                            v-model="form.city"
                            class="w-full"
                            filterable
                            :placeholder="$t('city')"
                        >
                            <el-option
                                v-for="city in cities"
                                :key="city"
                                :label="city"
                                :value="city"
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item :label="$t('employment type')" prop="employmentType">
                        <el-select
                            v-model="form.employmentType"
                            class="w-full capitalize"
                            :placeholder="$t('employment type')"
                        >
                            <el-option
                                v-for="type in jobTypes"
                                :key="type"
                                :label="type"
                                :value="type"
                                class="capitalize"
                            />
                        </el-select>
                    </el-form-item>
                    <el-form-item :label="$t('offer')">
                        <div class="grid grid-cols-5 gap-5">
                            <el-form-item class="col-span-2" prop="minOffer" :error="serverErrors.minOffer">
                                <el-input v-model="form.minOffer" :placeholder="$t('min offer')" />
                            </el-form-item>
                            <el-form-item class="col-span-2" prop="maxOffer" :error="serverErrors.maxOffer">
                                <el-input v-model="form.maxOffer" :placeholder="$t('max offer')" />
                            </el-form-item>
                            <el-form-item class="col-span-1" prop="currency">
                                <el-select
                                    v-model="form.currency"
                                    class="w-full"
                                >
                                    <el-option
                                        v-for="currency in currencies"
                                        :key="currency"
                                        :label="currency"
                                        :value="currency"
                                    />
                                </el-select>
                            </el-form-item>
                        </div>
                    </el-form-item>
                    <el-form-item :label="$t('deadline')" prop="deadline" :error="serverErrors.deadline">
                        <el-date-picker
                            v-model="form.deadline"
                            type="date"
                            value-format="yyyy-MM-dd"
                            format="dd/MM/yyyy"
                            :placeholder="$t('deadline')"
                        />
                    </el-form-item>
                    <div class="flex">
                        <SaveAsButton :handle-command="handleCommand" />
                    </div>
                </el-tab-pane>

                <el-tab-pane :label="$t('description')">
                    <el-form-item :label="$t('description')" prop="description" :error="serverErrors.description">
                        <TextEditor
                            :text="form.description"
                            :placeholder="$t('description')"
                            @onChangeText="(val) => onChangeValue('description', val)"
                        />
                    </el-form-item>
                    <el-form-item :label="$t('requirement')" prop="requirement" :error="serverErrors.requirement">
                        <TextEditor
                            :text="form.requirement"
                            :placeholder="$t('requirement')"
                            @onChangeText="(val) => onChangeValue('requirement', val)"
                        />
                    </el-form-item>
                    <el-form-item :label="$t('benefit')" prop="benefit" :error="serverErrors.benefit">
                        <TextEditor
                            :text="form.benefit"
                            :placeholder="$t('benefit')"
                            @onChangeText="(val) => onChangeValue('benefit', val)"
                        />
                    </el-form-item>
                    <div class="flex">
                        <SaveAsButton :handle-command="handleCommand" />
                    </div>
                </el-tab-pane>

                <el-tab-pane :label="$t('pipeline')">
                    <PipelineStage
                        :form="form"
                        :pipelines="pipelines"
                        :on-change-value="onChangeValue"
                    />
                    <div class="flex">
                        <SaveAsButton :handle-command="handleCommand" />
                    </div>
                </el-tab-pane>
            </el-tabs>
        </el-form>
    </div>
</template>
<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'JobEditForm',

        mixins: [formMixin, mixin],
    };
</script>
