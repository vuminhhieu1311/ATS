<template>
    <div class="m-10">
        <CVList :resumes="resumes" />
    </div>
</template>

<script>
    import CVList from '~/components/CV/List/index.vue';

    export default {
        name: 'CVListPage',

        components: {
            CVList,
        },

        layout: 'candidate',

        async asyncData({ $axios }) {
            const { data: resumes } = await $axios.$get('/resumes');

            return { resumes };
        },

        methods: {
        },
    };
</script>
