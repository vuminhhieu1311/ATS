<template>
    <el-card shadow="hover" class="board-item cursor-pointer">
        <div class="flex justify-between">
            <el-avatar
                size="large"
                :src="$get(candidate, 'user.profilePhotoUrl', require('~/assets/images/avatar.jpg'))"
            />
            <div class="info">
                <p class="font-medium text-base">{{ $get(candidate, 'user.name') }}</p>
                <p class="text-sm">{{ $get(candidate, 'user.email') }}</p>
            </div>
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
        </div>
    </el-card>
</template>

<script>
    export default {
        props: {
            candidate: {
                type: Object,
                required: true,
            },
            openInterviewForm: {
                type: Function,
                required: true,
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

<style lang="scss" scoped>
    .board-item {
        width: 270px;
        margin: 5px 0;
        box-sizing: border-box;
        .info {
            max-width: 140px;
            width: 140px;
        }
    }
    .dropdown-menu {
        margin-top: -20px !important;
    }
    .el-card__body {
        padding-bottom: 10px;
    }
</style>
