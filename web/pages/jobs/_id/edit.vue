<template>
    <div>
        <h3 class="capitalize text-xl font-medium mb-8">
            {{ $t('edit job') }}
        </h3>
        <EditForm
            :job="job"
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
            const { data: job } = await $axios.$get(`/jobs/${params.id}`);

            return { job };
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
