<template>
    <div>
        <CreateAssessmentForm
            :criteria="criteria"
            :submit-form="createAssessmentForm"
        />
    </div>
</template>

<script>
    import CreateAssessmentForm from '~/components/Assessment/Form/index.vue';
    import { MANAGE_ASSESSMENT_FORM } from '~/enums/permission';

    export default {
        name: 'CreateAssessmentFormPage',

        components: {
            CreateAssessmentForm,
        },

        middleware: 'permission',

        meta: {
            permissions: [MANAGE_ASSESSMENT_FORM],
        },

        data() {
            return {
                criteria: [],
            };
        },

        async fetch() {
            const { data: criteria } = await this.$axios.$get('criteria');

            this.criteria = criteria;
        },

        methods: {
            async createAssessmentForm(formData) {
                await this.$axios.$post('assessment-forms', {
                    ...formData,
                });
                this.$router.push('/assessment-forms');
                this.$message.success(this.$t('create successfully'));
            },
        },
    };
</script>
