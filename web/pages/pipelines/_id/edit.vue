<template>
    <div class="w-full">
        <EditPipeline
            :stages="stages"
            :pipeline="pipeline"
            :submit-form="submit"
        />
    </div>
</template>

<script>
    import EditPipeline from '~/components/Pipeline/Form/index.vue';

    export default {
        name: 'EditPipelinePage',

        components: {
            EditPipeline,
        },

        async asyncData({ $axios, params }) {
            const [
                { data: stages },
                { data: pipeline },
            ] = await Promise.all([
                $axios.$get('stages'),
                $axios.$get(`/pipelines/${params.id}`),
            ]);

            return {
                stages,
                pipeline,
            };
        },

        methods: {
            async submit(formData) {
                const { data: pipeline } = await this.$axios.$put(`pipelines/${this.$get(this.pipeline, 'id')}`, {
                    ...formData,
                });
                this.$message.success(this.$t('update successfully'));
                this.$router.push(`/pipelines?id=${this.$get(pipeline, 'id')}`);
            },
        },
    };
</script>
