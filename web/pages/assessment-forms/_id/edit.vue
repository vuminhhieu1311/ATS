<template>
    <div>
        <EditAssessmentForm
            :criteria="criteria"
            :assessment-form="assessmentForm"
            :submit-form="updateAssessmentForm"
        />
    </div>
</template>

<script>
    import EditAssessmentForm from '~/components/Assessment/Form/index.vue';
    import { MANAGE_ASSESSMENT_FORM } from '~/enums/permission';

    export default {
        name: 'EditAssessmentFormPage',

        components: {
            EditAssessmentForm,
        },

        middleware: 'permission',

        meta: {
            permissions: [MANAGE_ASSESSMENT_FORM],
        },

        async asyncData({ $axios, params }) {
            const [
                { data: criteria },
                { data: assessmentForm },
            ] = await Promise.all([
                $axios.$get('criteria'),
                $axios.$get(`/assessment-forms/${params.id}`),
            ]);

            return {
                criteria,
                assessmentForm,
            };
        },

        methods: {
            async updateAssessmentForm(formData) {
                await this.$axios.$put(`assessment-forms/${formData.assessmentFormId}`, {
                    ...formData,
                });
                this.$router.push('/assessment-forms');
                this.$message.success(this.$t('update successfully'));
            },
        },
    };
</script>
