<template>
    <div class="flex-auto">
        <div class="flex justify-between items-center mb-8">
            <h5 class="text-xl font-semibold uppercase">{{ $t("working experience") }}</h5>
            <el-button
                type="primary"
                size="mini"
                class="capitalize"
                @click="openExperienceForm(null)"
            >
                <span class="material-icons-outlined">add</span>
                {{ $t("experience") }}
            </el-button>
        </div>
        <el-row :gutter="40">
            <el-col
                v-for="item in $get(candidate, 'experiences')"
                :key="$get(item, 'id')"
                :span="12"
                :xl="8"
                class="mb-10"
            >
                <el-card :body-style="{ padding: '0px' }">
                    <div class="flex justify-center">
                        <img class="h-40 mt-5" :src="require('~/assets/images/suitcase.png')">
                    </div>
                    <div class="p-5">
                        <div class="text-lg text-text font-semibold">{{ $get(item, 'companyName') }}</div>
                        <div class="text-base">{{ getDate(item) }}</div>
                        <div class="text-base">{{ $get(item, 'location') }}</div>
                    </div>
                    <div class="flex justify-between">
                        <el-button
                            plain
                            size="small"
                            icon="el-icon-edit"
                            class="editBtn"
                            @click="openExperienceForm(item)"
                        >
                            {{ $t('edit') }}
                        </el-button>
                        <el-button
                            type="primary"
                            size="small"
                            icon="el-icon-delete"
                            class="deleteBtn"
                            @click="deleteExperience($get(item, 'id'))"
                        >
                            {{ $t('delete') }}
                        </el-button>
                    </div>
                </el-card>
            </el-col>
        </el-row>
        <ExperienceForm ref="experienceForm" :submit-form="submitForm" />
    </div>
</template>

<script>
    import moment from 'moment';
    import ExperienceForm from './ExperienceForm.vue';

    export default {
        name: 'ExperienceList',

        components: {
            ExperienceForm,
        },

        props: {
            candidate: {
                type: Object,
                required: true,
            },
            submitForm: {
                type: Function,
                required: true,
            },
            deleteExperience: {
                type: Function,
                required: true,
            },
        },

        methods: {
            openExperienceForm(experience) {
                this.$refs.experienceForm.open(experience);
            },
            getDate(experience) {
                const startDate = moment(this.$get(experience, 'startDate')).format('DD/MM/YYYY');
                const endDate = experience.endDate ? moment(experience.endDate).format('DD/MM/YYYY') : 'now';

                return `${startDate} - ${endDate}`;
            },
            closeExperienceForm() {
                this.$refs.experienceForm.close();
            },
        },
    };
</script>

<style lang="scss" scoped>
    .deleteBtn {
        width: 50%;
        margin: unset !important;
        border: unset !important;
    }
    .editBtn {
        width: 50%;
        margin: unset !important;
        border: unset !important;
        background-color: theme('colors.light') !important;
    }
</style>
