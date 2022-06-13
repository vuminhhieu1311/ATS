<template>
    <div>
        <embed v-if="resume" class="resume-viewer" :src="`data:application/pdf;base64,${resume}`">
        <el-empty v-else :description="$t('no data')" class="capitalize" />
    </div>
</template>

<script>
    export default {
        name: 'CvEmbed',

        props: {
            resume: String,
        },
    };
</script>

<style lang="scss" scoped>
    .resume-viewer {
        height: 100vh;
        width: 100%;
    }
</style>
