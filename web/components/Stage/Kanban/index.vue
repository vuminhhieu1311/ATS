<template>
    <div class="board-column rounded border">
        <div
            class="board-column-header bg-lightPrimary
            border flex justify-between items-center pl-5 pr-1 rounded-t-lg"
        >
            <div>
                <span class="text-lg font-medium">{{ $get(stage, 'name') }}</span>
                <el-badge :value="$get(candidates, 'length')" type="primary" />
            </div>
            <el-dropdown class="flex items-center" trigger="click">
                <span class="el-dropdown-link material-icons-outlined">more_vert</span>
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>{{ $t('add candidate') }}</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
        <draggable
            v-infinite-scroll="load"
            v-loading="candidateLoading"
            :scroll-sensitivity="350"
            :force-fallback="true"
            :list="candidates"
            v-bind="$attrs"
            class="board-column-content pt-3 overflow-y-auto flex flex-col justify-start items-center"
            :set-data="setData"
            @change="updateStage"
        >
            <div v-for="(candidate, index) in candidates" :key="index">
                <CandidateCard
                    :candidate="candidate"
                    :open-interview-form="openInterviewForm"
                    :star-candidate="starCandidate"
                />
            </div>
        </draggable>
        <CreateInterviewForm
            ref="createInterviewForm"
            :staffs="staffs"
            :rooms="rooms"
            :mail-templates="mailTemplates"
            :assessment-forms="assessmentForms"
            :submit-form="createInterviewSchedule"
        />
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import CreateInterviewForm from '~/components/Interview/CreateForm/index.vue';
    import CandidateCard from '../../Candidate/CandidateCard.vue';
    import mixin from './mixin';

    export default {
        name: 'StageKanban',

        components: {
            draggable,
            CandidateCard,
            CreateInterviewForm,
        },

        mixins: [mixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
