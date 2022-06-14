<template>
    <div>
        <embed
            v-if="$get(candidate, 'resumeUrl')"
            width="100%"
            height="800"
            :src="resumeUrl"
            type="application/pdf"
        >
        <el-empty v-else :description="$t('no data')" class="capitalize" />
    </div>
</template>

<script>
    export default {
        name: 'CvEmbed',

        props: {
            candidate: {
                type: Object,
                required: true,
            },
        },

        computed: {
            resumeUrl() {
                const baseUrl = process.env.BACKEND_URL;
                const link = this.$get(this.candidate, 'resumeUrl');

                return `${baseUrl}${link}`;
            },
        },
    };
</script>
