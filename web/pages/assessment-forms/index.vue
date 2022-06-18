<template>
    <div>
        <AssessmentFormList
            :assessment-forms="assessmentForms"
            :search-assessment-forms="searchAssessmentForms"
        />
    </div>
</template>

<script>
    import AssessmentFormList from '~/components/Assessment/List/index.vue';

    export default {
        name: 'AssessmentFormPage',

        components: {
            AssessmentFormList,
        },

        async asyncData({ $axios }) {
            const { data: assessmentForms } = await $axios.$get('assessment-forms');

            return {
                assessmentForms,
            };
        },

        methods: {
            async searchAssessmentForms(query) {
                const { data: assessmentForms } = await this.$axios.$get('assessment-forms', { params: query });

                this.assessmentForms = assessmentForms;
            },
        },
    };
</script>
