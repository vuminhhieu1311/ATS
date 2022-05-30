<template>
    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
        <div class="flex justify-between items-center my-8">
            <h5 class="text-xl font-semibold uppercase">{{ $t("education") }}</h5>
            <el-button
                type="primary"
                size="mini"
                class="capitalize"
                @click="openEducationForm(null)"
            >
                <span class="material-icons-outlined">add</span>
                {{ $t("education") }}
            </el-button>
        </div>
        <el-row :gutter="40">
            <el-col
                v-for="item in $get($auth.user, 'candidate.education')"
                :key="$get(item, 'id')"
                :span="12"
                :xl="8"
                class="mb-10"
            >
                <el-card :body-style="{ padding: '0px' }">
                    <div class="flex justify-center">
                        <img class="h-40 mt-5" :src="require('~/assets/images/education.png')">
                    </div>

                    <div class="p-5">
                        <div class="text-lg text-text font-semibold">{{ $get(item, 'school_name') }}</div>
                        <div class="text-base">{{ getDate(item) }}</div>
                        <div class="text-base">{{ $get(item, 'field_of_study') }}</div>
                    </div>
                    <div class="flex justify-between">
                        <el-button
                            plain
                            size="small"
                            icon="el-icon-edit"
                            class="editBtn"
                            @click="openEducationForm(item)"
                        >
                            {{ $t('edit') }}
                        </el-button>
                        <el-button
                            type="primary"
                            size="small"
                            icon="el-icon-delete"
                            class="deleteBtn"
                            @click="deleteEducation($get(item, 'id'))"
                        >
                            {{ $t('delete') }}
                        </el-button>
                    </div>
                </el-card>
            </el-col>
        </el-row>
        <EducationForm ref="educationForm" />
    </div>
</template>

<script>
    import moment from 'moment';
    import EducationForm from './EducationForm.vue';

    export default {
        name: 'EducationList',

        components: {
            EducationForm,
        },

        methods: {
            openEducationForm(education) {
                this.$refs.educationForm.open(education);
            },
            getDate(education) {
                const startDate = moment(this.$get(education, 'start_date')).format('DD/MM/YYYY');
                const endDate = education.end_date ? moment(education.end_date).format('DD/MM/YYYY') : 'now';

                return `${startDate} - ${endDate}`;
            },
            async deleteEducation(educationId) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete education'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        const user = await this.$axios.$delete(`education/${educationId}`);
                        this.$auth.setUser(user);
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
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
