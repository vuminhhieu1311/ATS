<template>
    <div>
        <div class="relative pt-16 pb-24">
            <div class="landing-header absolute top-0 w-full h-full bg-center bg-cover">
                <span id="blackOverlay" class="w-full h-full absolute opacity-70 bg-black" />
            </div>
            <div class="relative mx-auto">
                <div class="pl-10 mt-10">
                    <p class="text-white font-semibold text-3xl leading-relaxed uppercase">
                        {{ $get(job, 'name') }}
                    </p>
                    <nuxt-link :to="{ hash:'#application-form'}">
                        <el-button
                            type="primary"
                            class="apply-button uppercase"
                        >
                            <span class="material-icons mr-3">add_circle</span>
                            <span class="flex items-center text-2xl font-medium">{{ $t('apply now') }}</span>
                        </el-button>
                    </nuxt-link>
                </div>
            </div>
        </div>
        <div>
            <div class="mx-auto px-5">
                <div class="flex flex-wrap">
                    <JobBasicInformation :job="job" />
                    <Overview :job="job" />
                </div>
            </div>
        </div>
        <ApplicationForm :job="job" />
    </div>
</template>

<script>
    import JobBasicInformation from './BasicInformation.vue';
    import Overview from './Overview.vue';
    import ApplicationForm from './ApplicationForm/index.vue';

    export default {
        name: 'JobDetail',

        components: {
            JobBasicInformation,
            Overview,
            ApplicationForm,
        },

        props: {
            job: {
                type: Object,
                required: true,
            },
        },
    };
</script>

<style lang="scss">
    .landing-header {
        background-image: url("~/assets/images/banner.png");
        height: 430px;
    }
    .apply-button {
        padding: 25px 50px !important;
        margin-top: theme('spacing.10') !important;
    }
</style>
