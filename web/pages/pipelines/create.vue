<template>
    <div class="w-full">
        <CreatePipeline :stages="stages" :submit-form="submit" />
    </div>
</template>

<script>
    import CreatePipeline from '~/components/Pipeline/Form/index.vue';
    import { MANAGE_PIPELINE } from '~/enums/permission';

    export default {
        name: 'CreatePipelinePage',

        components: {
            CreatePipeline,
        },

        middleware: 'permission',

        meta: {
            permissions: [MANAGE_PIPELINE],
        },

        async asyncData({ $axios }) {
            const { data: stages } = await $axios.$get('stages');

            return {
                stages,
            };
        },

        methods: {
            async submit(formData) {
                const { data: pipeline } = await this.$axios.$post('pipelines', {
                    ...formData,
                });
                this.$message.success(this.$t('create successfully'));
                this.$router.push(`/pipelines?id=${this.$get(pipeline, 'id')}`);
            },
        },
    };
</script>
