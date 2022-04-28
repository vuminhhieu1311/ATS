<template>
    <div>
        <h3 class="capitalize text-xl font-medium mb-8">
            {{ $t('edit job') }}
        </h3>
        <EditForm
            :job="job"
            :pipelines="pipelines"
            :submit-form="submitEditForm"
        />
    </div>
</template>

<script>
    import EditForm from '~/components/Job/EditForm/index.vue';

    export default {
        name: 'EditJobPage',

        components: {
            EditForm,
        },

        async asyncData({ $axios, params }) {
            const [
                { data: job },
                { data: pipelines },
            ] = await Promise.all([
                $axios.$get(`/jobs/${params.id}`),
                $axios.$get('pipelines'),
            ]);

            return {
                job,
                pipelines,
            };
        },

        data() {
            return {
                pipelines: [],
            };
        },

        methods: {
            async submitEditForm(formData) {
                await this.$axios.put(`/jobs/${this.job.id}`, {
                    ...formData,
                });

                this.$router.push('/jobs');
                this.$message.success(this.$t('update successfully'));
            },
        },
    };
</script>
