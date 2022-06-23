<template>
    <div class="cv-builder grid grid-cols-7 h-screen">
        <div class="cv-builder-tabs col-span-2 border-r">
            <el-tabs type="card">
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">list</span>
                    <div class="p-5">
                        <h4 class="font-semibold text-lg capitalize mb-2">{{ $t('contents of CV') }}</h4>
                        <el-select
                            v-model="outline"
                            class="w-full mb-5"
                            multiple
                            collapse-tags
                            placeholder="Select"
                        >
                            <el-option
                                v-for="(item, index) in availableEntries"
                                :key="index"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                        <Outline :outline="outline" :delete-outline="deleteOutline" />
                    </div>
                </el-tab-pane>
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">grid_view</span>
                    <div id="blocks-container" />
                </el-tab-pane>
                <el-tab-pane>
                    <span slot="label" class="text-text material-icons-outlined">brush</span>
                    <div id="styles-container" />
                </el-tab-pane>
            </el-tabs>
        </div>
        <div class="col-span-5 mx-5">
            <div class="gjs-navbar flex justify-end items-center">
                <div class="panel__basic-actions" />
                <span
                    class="text-primary cursor-pointer text-3xl material-icons-outlined"
                    @click="downloadResume"
                >
                    file_download
                </span>
            </div>
            <div id="editor" data-attribute="editor">
                <CVTemplate2 ref="resumeTemplate" :outline="outline" />
            </div>
        </div>
    </div>
</template>

<script>
    import mixin from './mixin';
    import CVTemplate2 from '../Template/Template2/index.vue';
    import Outline from './Outline.vue';

    export default {
        name: 'CVBuilder',

        components: {
            CVTemplate2,
            Outline,
        },

        mixins: [mixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
