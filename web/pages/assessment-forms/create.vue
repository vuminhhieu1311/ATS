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

    export default {
        name: 'CreateAssessmentFormPage',

        components: {
            CreateAssessmentForm,
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
