<template>
    <div>
        <CVBuilder :resume="resume" />
    </div>
</template>

<script>
    import CVBuilder from '~/components/CV/Builder/index.vue';

    export default {
        name: 'CVBuilderPage',

        components: {
            CVBuilder,
        },

        layout: 'candidate',

        async asyncData({ $axios, params }) {
            const { data: resume } = await $axios.$get(`/resumes/${params.id}`);

            return { resume };
        },

        methods: {
        },
    };
</script>
