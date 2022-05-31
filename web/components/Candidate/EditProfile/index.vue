<template>
    <div class="vertical-tabs">
        <el-tabs
            type="card"
            tab-position="left"
            class="w-full m-8 rounded-lg border-0 pr-20"
        >
            <el-tab-pane>
                <div slot="label" class="text-lg flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">person</span>
                    <span>{{ $t("personal info") }}</span>
                </div>
                <PersonalInfo />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-lg flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">school</span>
                    <span>{{ $t("education") }}</span>
                </div>
                <Education />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-lg flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">work</span>
                    <span>{{ $t("experience") }}</span>
                </div>
                <Experience />
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import PersonalInfo from './PersonalInfo.vue';
    import Education from './Education.vue';
    import Experience from './Experience.vue';

    export default {
        name: 'EditProfile',

        components: {
            PersonalInfo,
            Education,
            Experience,
        },
    };
</script>
