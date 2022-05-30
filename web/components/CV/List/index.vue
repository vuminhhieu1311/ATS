<template>
    <div class="grid grid-cols-3">
        <div class="col-span-2">
            <h1 class="text-xl font-semibold mb-5 capitalize">{{ $t('your cv') }}</h1>
            <el-row :gutter="40">
                <el-col
                    v-for="resume in resumes"
                    :key="$get(resume, 'id')"
                    :span="8"
                    class="mb-10"
                >
                    <el-card :body-style="{ padding: '0px' }">
                        <nuxt-link :to="`/ats/cv/${resume.uuid}/edit`">
                            <img :src="$get(resume, 'template.imageUrl')">
                        </nuxt-link>
                        <div class="p-5">
                            <span class="text-base">{{ lastActivityDate($get(resume, 'updatedAt')) }}</span>
                        </div>
                        <div>
                            <div class="w-full">
                                <nuxt-link :to="`/ats/cv/${resume.uuid}/edit`">
                                    <el-button
                                        plain
                                        size="small"
                                        class="editBtn"
                                        icon="el-icon-edit"
                                        @click="deleteResume(resume)"
                                    >
                                        {{ $t('edit') }}
                                    </el-button>
                                </nuxt-link>
                                <el-button
                                    type="primary"
                                    size="small"
                                    class="deleteBtn"
                                    icon="el-icon-delete"
                                    @click="deleteResume(resume)"
                                >
                                    {{ $t('delete') }}
                                </el-button>
                            </div>
                        </div>
                    </el-card>
                </el-col>
            </el-row>
            <div class="border-t pt-5">
                <h1 class="text-xl font-semibold mb-5 capitalize">{{ $t('cv templates') }}</h1>
            </div>
        </div>
        <div class="col-span-1">
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'CVList',

        components: {
        },

        props: {
            resumes: {
                type: Array,
                required: true,
            },
        },

        methods: {
            deleteResume() {
                console.log();
            },
            lastActivityDate(date) {
                return moment(date).fromNow();
            },
        },
    };
</script>

<style lang="scss" scoped>
    .deleteBtn {
        width: 100%;
        margin: unset !important;
        border: unset !important;
    }
    .editBtn {
        width: 100%;
        margin: unset !important;
        border: unset !important;
        background-color: theme('colors.light') !important;
    }
</style>
