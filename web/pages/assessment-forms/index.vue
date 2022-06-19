<template>
    <div>
        <AssessmentFormList
            :assessment-forms="assessmentForms"
            :search-assessment-forms="searchAssessmentForms"
            :delete-assessment-form="deleteAssessmentForm"
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
            async deleteAssessmentForm(id) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete assessment form'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        await this.$axios.$delete(`assessment-forms/${id}`);
                        this.assessmentForms = this.assessmentForms.filter((item) => item.id !== id);
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
