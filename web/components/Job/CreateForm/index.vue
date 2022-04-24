<template>
    <div>
        <el-steps :active="active" align-center>
            <el-step title="Step 1" />
            <el-step title="Step 2" />
            <el-step title="Step 3" />
        </el-steps>
        <el-form
            ref="form"
            :model="form"
            :rules="formRules"
            size="medium"
            label-width="18%"
            label-position="left"
            class="mt-8"
        >
            <div v-show="active === 0">
                <el-form-item :label="$t('name')" prop="name" :error="serverErrors.name">
                    <el-input v-model="form.name" :placeholder="$t('name')" />
                </el-form-item>
                <el-form-item :label="$t('country')" prop="country">
                    <el-select
                        v-model="form.country"
                        class="w-full"
                        filterable
                        clearable=""
                        :placeholder="$t('country')"
                    >
                        <el-option
                            v-for="(country, index) in countries"
                            :key="index"
                            :label="$get(country, 'name')"
                            :value="$get(country, 'name')"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item :label="$t('city')" prop="city" :error="serverErrors.city">
                    <el-select
                        v-model="form.city"
                        class="w-full"
                        filterable
                        :loading="loadingCities"
                        :placeholder="$t('city')"
                    >
                        <el-option
                            v-for="name in cities"
                            :key="name"
                            :label="name"
                            :value="name"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item :label="$t('type')" prop="type">
                    <el-select
                        v-model="form.type"
                        class="w-full capitalize"
                        :placeholder="$t('type')"
                    >
                        <el-option
                            v-for="name in jobTypes"
                            :key="name"
                            :label="name"
                            :value="name"
                            class="capitalize"
                        />
                    </el-select>
                </el-form-item>
                <el-form-item :label="$t('offer')">
                    <el-col :span="9">
                        <el-form-item prop="min_offer" :error="serverErrors.min_offer">
                            <el-input v-model="form.min_offer" :placeholder="$t('job.min_offer')" />
                        </el-form-item>
                    </el-col>
                    <el-col class="text-center" :span="2">-</el-col>
                    <el-col :span="9">
                        <el-form-item prop="max_offer" :error="serverErrors.max_offer">
                            <el-input v-model="form.max_offer" :placeholder="$t('job.max_offer')" />
                        </el-form-item>
                    </el-col>
                    <el-col class="text-center" :span="2">-</el-col>
                    <el-col :span="2">
                        <el-form-item prop="currency">
                            <el-select
                                v-model="form.currency"
                                class="w-full"
                                :placeholder="$t('job.currency')"
                            >
                                <el-option
                                    v-for="name in jobCurrencies"
                                    :key="name"
                                    :label="name"
                                    :value="name"
                                />
                            </el-select>
                        </el-form-item>
                    </el-col>
                </el-form-item>
                <el-form-item :label="$t('deadline')" prop="deadline" :error="serverErrors.deadline">
                    <el-date-picker
                        v-model="form.deadline"
                        type="date"
                        value-format="yyyy-MM-dd"
                        :placeholder="$t('job.deadline')"
                    />
                </el-form-item>
                <el-form-item class="text-right">
                    <el-button v-if="!step" type="primary" @click="propStep">
                        {{ $t('next') }}
                        <span class="material-icons-outlined ml-2 text-base">
                            arrow_forward_ios
                        </span>
                    </el-button>
                    <el-dropdown v-if="job" @command="handleCommand">
                        <el-button type="primary" class="capitalize el-dropdown-link">
                            {{ $t('save as') }} <i class="el-icon-arrow-down el-icon--right" />
                        </el-button>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item
                                v-for="(value, index) in jobStatuses"
                                :key="index"
                                :command="value"
                                class="capitalize"
                            >
                                {{ value }}
                            </el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </el-form-item>
            </div>
            <div v-show="active === 1">
                <el-form-item :label="$t('description')" prop="description" :error="serverErrors.description">
                    <TextEditor
                        :text="form.description"
                        :placeholder="$t('job.description')"
                        @onChangeText="onChangeDescription"
                    />
                </el-form-item>
                <el-form-item :label="$t('benefit')" prop="benefit" :error="serverErrors.benefit">
                    <TextEditor
                        :text="form.benefit"
                        :placeholder="$t('job.benefit')"
                        @onChangeText="onChangeBenefit"
                    />
                </el-form-item>
                <el-form-item :label="$t('requirement')" prop="requirement" :error="serverErrors.requirement">
                    <TextEditor
                        :text="form.requirement"
                        :placeholder="$t('job.requirement')"
                        @onChangeText="onChangeRequirement"
                    />
                </el-form-item>
                <div class="flex justify-end">
                    <el-button type="info" class="capitalize" @click="resetForm">
                        {{ $t('reset') }}
                    </el-button>
                    <el-button v-if="step" type="primary" @click="propStep">
                        <span class="material-icons-outlined mr-2 text-base">
                            arrow_back_ios
                        </span>
                        {{ $t('previous') }}
                    </el-button>
                    <el-dropdown class="ml-3" @command="handleCommand">
                        <el-button type="primary" class="capitalize el-dropdown-link">
                            {{ $t('save as') }} <i class="el-icon-arrow-down el-icon--right" />
                        </el-button>
                        <el-dropdown-menu slot="dropdown">
                            <el-dropdown-item
                                v-for="(value, index) in jobStatuses"
                                :key="index"
                                :command="value"
                                class="capitalize"
                            >
                                {{ value }}
                            </el-dropdown-item>
                        </el-dropdown-menu>
                    </el-dropdown>
                </div>
            </div>
        </el-form>
    </div>
</template>
<script>
    import formMixin from '~/mixins/form';
    import mixin from './mixin';

    export default {
        name: 'JobCreateForm',

        mixins: [formMixin, mixin],
    };
</script>
