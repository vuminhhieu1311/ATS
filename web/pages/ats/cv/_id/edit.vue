<template>
    <div>
        <CVBuilder />
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

        methods: {
        },
    };
</script>
