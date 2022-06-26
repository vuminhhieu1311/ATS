<template>
    <div class="w-full">
        <el-button
            type="primary"
            class="capitalize"
            @click="openCreateStageForm"
        >
            <span class="material-icons mr-1">add</span>
            {{ $t('new stage') }}
        </el-button>
        <StageList
            :stages="stages"
            :meta="meta"
            :delete-stage="deleteStage"
            @handleOpenEditStage="openEditStage"
            @handleUpdateStage="updateStage"
        />
        <CreateStageForm
            ref="createStageForm"
            @addNewStage="addNewStage"
        />
    </div>
</template>

<script>
    // import _findIndex from 'lodash/findIndex';
    import StageList from '~/components/Stage/List/index.vue';
    import CreateStageForm from '~/components/Stage/CreateForm/index.vue';

    export default {
        name: 'StagePage',

        components: {
            StageList,
            CreateStageForm,
        },

        async asyncData({ $axios, query }) {
            const { data: stages } = await $axios.$get('stages', { params: query });

            return {
                stages,
            };
        },
        data() {
            return {
                stageId: '',
            };
        },
        watchQuery: true,

        methods: {
            openCreateStageForm() {
                this.$refs.createStageForm.open();
            },
            async addNewStage(stage) {
                this.stages.unshift(stage);
            },
            // async openEditStage(stageId) {
            //     try {
            //         this.stageId = stageId;
            //         const { data: { data: stage } } = await showStage(stageId);
            //         this.$refs.formStage.open(stageId, stage);
            //     } catch (error) {
            //         this.$handleError(error);
            //     }
            // },
            // async updateStage(data) {
            //     try {
            //         const { data: { data: stage } } = await updateStage(data.id, {
            //             name: data.name,
            //             is_active: data.isActive,
            //         });
            //         const index = _findIndex(this.stages, ['id', stage.id]);
            //         if (index !== -1) {
            //             this.stages.splice(index, 1, stage);
            //         }
            //         this.$message.success(this.$t('messages.success'));
            //     } catch (error) {
            //         this.$handleError(error);
            //     }
            // },

            // async handleUpdateStage(data) {
            //     this.loading = true;
            //     try {
            //         const { data: { data: stage } } = await updateStage(this.stageId, {
            //             name: data.name,
            //             is_active: data.is_active,
            //         });
            //         this.loading = false;
            //         const index = _findIndex(this.stages, ['id', stage.id]);
            //         if (index !== -1) {
            //             this.stages.splice(index, 1, stage);
            //         }
            //         this.$refs.formStage.onClose();
            //         this.$message.success(this.$t('messages.edit_stage'));
            //     } catch (error) {
            //         this.loading = false;
            //         this.$handleError(error);
            //     }
            // },
            async deleteStage(stageId) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete stage'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        await this.$axios.$delete(`stages/${stageId}`);
                        this.stages = this.stages.filter((item) => item.id !== stageId);
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
