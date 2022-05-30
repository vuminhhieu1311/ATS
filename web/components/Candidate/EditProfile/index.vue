<template>
    <el-tabs
        type="card"
        tab-position="left"
        class="w-full m-8 rounded-lg border-0"
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
                <span class="material-icons mr-2">account_box</span>
                <span>{{ $t("resume") }}</span>
            </div>
            <div>
                Hello
            </div>
        </el-tab-pane>
        <el-tab-pane>
            <div slot="label" class="text-lg flex items-center pt-2 capitalize">
                <span class="material-icons mr-2">work</span>
                <span>{{ $t("experience") }}</span>
            </div>
        </el-tab-pane>
    </el-tabs>
</template>

<script>
    import PersonalInfo from './PersonalInfo.vue';
    import Education from './Education.vue';

    export default {
        name: 'EditProfile',

        components: {
            PersonalInfo,
            Education,
        },

        props: {
            user: {
                type: Object,
                required: true,
            },
        },
    };
</script>
