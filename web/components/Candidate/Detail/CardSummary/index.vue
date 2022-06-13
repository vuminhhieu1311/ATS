<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white w-full mb-6 px-5 shadow-xl rounded-lg mt-16"
    >
        <div class="avatar flex flex-wrap justify-center w-full px-4">
            <el-avatar
                :size="140"
                :src="$get(candidate, 'avatarUrl')"
                class="-mt-16 uppercase"
            >
                {{ candidateName }}
            </el-avatar>
        </div>
        <h3 class="text-center mt-5">{{ $get(candidate, 'name') }}</h3>
        <div class="pt-7 w-full px-4">
            <div class="mb-4 text-lg leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">view_week</span>
                {{ $t("stage") }}:
                <el-tag type="warning" size="normal" class="capitalize ml-2">
                    {{ $get(candidate, 'currentStage.name') }}
                </el-tag>
            </div>
            <div class="mb-4 text-lg leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">location_on</span>
                <span>
                    {{ $get(candidate, 'address') }}
                </span>
            </div>
            <div class="mb-4 text-lg leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">work_outline</span>
                <span>
                    {{ $get(candidate, 'job.name', $t('no data')) }}
                </span>
            </div>
            <div class="text-lg leading-relaxed flex items-center">
                <span class="material-icons-outlined mr-3">school</span>
                <span v-if="candidate.education">
                    {{ $get(candidate, 'education[0].schoolName', null) }}
                </span>
                <el-button
                    v-else
                    type="primary"
                    plain
                    class="capitalize"
                >
                    <span class="material-icons mr-1 text-base">add</span>
                    <span class="text-base">{{ $t("add education") }}</span>
                </el-button>
            </div>
        </div>
        <div class="w-full px-4">
            <div class="my-7 leading-relaxed flex justify-between">
                <h4 class="font-semibold">{{ $t("tags") }}</h4>
                <el-button type="primary" class="add-btn">
                    <span class="material-icons">add</span>
                </el-button>
            </div>
            <div class="mb-7 leading-relaxed flex justify-between">
                <h4 class="font-semibold">{{ $t("custom attributes") }}</h4>
                <el-button type="primary" class="add-btn">
                    <span class="material-icons">add</span>
                </el-button>
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
                const name = this.$get(this.candidate, 'name', null);

                return name ? name.slice(0, 1) : null;
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
