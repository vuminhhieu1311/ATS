<template>
    <el-card shadow="hover" class="board-item cursor-pointer">
        <div class="flex justify-start">
            <nuxt-link :to="`/candidates/${$get(candidate, 'id')}`">
                <vue-avatar
                    :username="$get(candidate, 'user.name')"
                    :src="`http://localhost:8000${$get(candidate, 'user.profilePhotoUrl')}`"
                    :size="35"
                />
            </nuxt-link>
            <div class="ml-2">
                <div class="flex justify-between">
                    <nuxt-link :to="`/candidates/${$get(candidate, 'id')}`">
                        <div class="info">
                            <p class="text font-medium text-base">{{ $get(candidate, 'user.name') }}</p>
                            <p class="text mt-1 text-sm">{{ $get(candidate, 'user.email') }}</p>
                        </div>
                    </nuxt-link>
                    <div>
                        <el-dropdown trigger="click">
                            <span class="el-dropdown-link material-icons-outlined">expand_more</span>
                            <el-dropdown-menu slot="dropdown" class="dropdown-menu">
                                <el-dropdown-item
                                    @click.native="onViewCandidateDetail"
                                >
                                    {{ $t('view detail') }}
                                </el-dropdown-item>
                                <el-dropdown-item>{{ $t('delete') }}</el-dropdown-item>
                                <el-dropdown-item
                                    @click.native="openInterviewForm(candidate)"
                                >
                                    {{ $t('schedule interview') }}
                                </el-dropdown-item>
                                <el-dropdown-item
                                    v-if="$get(candidate, 'interviews.length', 0)"
                                    @click.native="clickShowInterviews"
                                >
                                    {{ $t('list of interviews') }}
                                </el-dropdown-item>
                            </el-dropdown-menu>
                        </el-dropdown>
                        <CandidateStar
                            class="-mt-2"
                            :candidate="candidate"
                            :star-candidate="starCandidate"
                        />
                    </div>
                </div>
                <div class="flex mt-1 items-center text-gray-500">
                    <el-tooltip
                        :content="`${$t('last updated at')} ${updatedAt}`"
                        placement="bottom"
                    >
                        <div class="flex items-center">
                            <span class="material-icons-outlined text-base mr-1">schedule</span>
                            <span class="text-xs mr-2">{{ lastActivityDate }}</span>
                        </div>
                    </el-tooltip>
                    <div v-if="numInterviews" class="flex items-center">
                        <span class="material-icons-outlined mr-1 text-base font-normal text-gray-500">
                            event_available
                        </span>
                        <span class="text-xs">{{ numInterviews }} interviews</span>
                    </div>
                </div>
            </div>
        </div>
    </el-card>
</template>

<script>
    import moment from 'moment';
    import CandidateStar from './CandidateStar.vue';

    export default {
        components: {
            CandidateStar,
        },

        props: {
            candidate: {
                type: Object,
                required: true,
            },
            openInterviewForm: {
                type: Function,
                required: true,
            },
            starCandidate: {
                type: Function,
                required: true,
            },
        },

        computed: {
            updatedAt() {
                return moment(this.$get(this.candidate, 'updatedAt')).format('DD/MM/YYYY LT');
            },
            lastActivityDate() {
                return moment(this.$get(this.candidate, 'updatedAt')).fromNow();
            },
            numInterviews() {
                return this.$get(this.candidate, 'currentCandidateJob.interviews.length', 0);
            },
        },

        methods: {
            onViewCandidateDetail() {
                this.$router.push(`/candidates/${this.$get(this.candidate, 'id')}`);
            },
            clickShowInterviews() {
                this.handleShowInterviews(this.$(this.candidate, 'id'));
            },
        },
    };
</script>

<style lang="scss">
    .board-item {
        width: 280px;
        margin: 5px 0;
        box-sizing: border-box;
        .info {
            max-width: 195px;
            width: 195px;
            .text {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        }
        .el-card__body {
            padding: 10px !important;
        }
    }
    .dropdown-menu {
        margin-top: -5px !important;
    }
</style>
