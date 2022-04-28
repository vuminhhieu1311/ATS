<template>
    <el-dropdown trigger="click" :hide-on-click="false">
        <span class="ml-5 material-icons-outlined">settings</span>
        <el-dropdown-menu slot="dropdown">
            <el-dropdown-item icon="el-icon-plus" @click.native="onCreatePipeline">
                {{ $t('create pipeline') }}
            </el-dropdown-item>
            <el-dropdown-item v-if="pipeline" icon="el-icon-edit" @click.native="onEditPipeline">
                {{ $t('edit pipeline') }}
            </el-dropdown-item>
        </el-dropdown-menu>
    </el-dropdown>
</template>
<script>
    export default {
        props: {
            pipeline: {
                type: Object,
                default() {
                    return null;
                },
            },
        },

        methods: {
            onCreatePipeline() {
                this.$router.push('/pipelines/create');
            },
            onEditPipeline() {
                this.$router.push(`/pipelines/${this.$get(this.pipeline, 'id')}/edit`);
            },
        },
    };
</script>
