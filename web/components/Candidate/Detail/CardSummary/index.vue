<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 px-5 shadow-xl rounded-lg mt-16"
    >
        <div class="avatar flex flex-wrap justify-center w-full px-4">
            <el-avatar
                :size="140"
                :src="profilePhotoUrl"
                class="-mt-16 uppercase"
            >
                {{ candidateName }}
            </el-avatar>
        </div>
        <div class="text-center mt-5">
            <p class="text font-medium text-xl">
                {{ $get(candidate, 'user.name') }}
            </p>
            <p class="text mt-1 text-sm">
                {{ $get(candidate, 'user.email') }}
            </p>
            <el-rate
                class="mt-2"
                :value="$get(candidate, 'finalScore', 0)"
                disabled
                show-score
                text-color="#ff9900"
                :score-template="`${$get(candidate, 'finalScore', 0)}/5`"
            />
        </div>
        <div class="py-7 w-full px-4">
            <div class="mb-4 leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">view_week</span>
                {{ $t("stage") }}:
                <el-tag type="warning" size="normal" class="capitalize ml-2">
                    {{ $get(candidate, 'currentCandidateJob.stage.name') }}
                </el-tag>
            </div>
            <div class="mb-4 leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">location_on</span>
                <span>
                    {{ $get(candidate, 'user.address') }}
                </span>
            </div>
            <div class="mb-4 leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">work_outline</span>
                <span>
                    {{ $get(candidate, 'currentCandidateJob.job.name', $t('no data')) }}
                </span>
            </div>
            <div class="leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">school</span>
                <span>
                    {{ $get(candidate, 'education[0].schoolName', $t('no data')) }}
                </span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'CardSummary',

        props: {
            candidate: {
                type: Object,
                required: true,
            },
        },

        computed: {
            candidateName() {
                const name = this.$get(this.candidate, 'user.name', null);
                return name ? name.slice(0, 1) : null;
            },
            profilePhotoUrl() {
                const baseUrl = process.env.BACKEND_URL;
                return `${baseUrl}${this.$get(this.candidate, 'user.profilePhotoUrl')}`;
            },
        },
    };
</script>

<style lang="scss">
    .avatar {
        .el-avatar {
            font-size: theme('fontSize.4xl');
        }
    }
    .add-btn {
        padding: 0 2px !important;
    }
</style>
