<template>
    <div class="w-full">
        <CreatePipeline :stages="stages" :submit-form="submit" />
    </div>
</template>

<script>
    import CreatePipeline from '~/components/Pipeline/CreateForm/index.vue';

    export default {
        name: 'CreatePipelinePage',

        components: {
            CreatePipeline,
        },

        async asyncData({ $axios }) {
            const { data: stages } = await $axios.$get('stages');

            return {
                stages,
            };
        },

        methods: {
            async submit(formData) {
                console.log(formData);
                // try {
                //     const pipelineResponse = await createPipeline({
                //         name: formData.name,
                //         stage_ids: formData.stageIds,
                //         job_ids: formData.jobIds,
                //     });
                //     this.$message.success(this.$t('messages.create_pipeline'));
                //     this.$router.push(`/pipelines?id=${pipelineResponse.data.data.id}`);
                // } catch (error) {
                //     this.$handleError(error);
                // }
            },
        },
    };
</script>
