<template>
    <div class="cv-builder grid grid-cols-5 h-screen">
        <div class="col-span-1 border-r">
            <el-tabs type="card">
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">grid_view</span>
                    <div id="blocks-container" />
                </el-tab-pane>
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">brush</span>
                    <div id="styles-container" />
                </el-tab-pane>
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">list</span>
                    User
                </el-tab-pane>
            </el-tabs>
        </div>
        <div class="col-span-4 mx-5">
            <div class="gjs-navbar flex justify-end items-center">
                <div class="panel__basic-actions" />
                <span class="text-primary cursor-pointer text-3xl material-icons-outlined">file_download</span>
                <span class="text-primary cursor-pointer text-2xl ml-2 material-icons-outlined">save</span>
            </div>
            <CVTemplate1 />
        </div>
    </div>
</template>

<script>
    import mixin from './mixin';
    import CVTemplate1 from '../Template/Template2.vue';

    export default {
        name: 'CVBuilder',

        components: {
            CVTemplate1,
        },

        mixins: [mixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
