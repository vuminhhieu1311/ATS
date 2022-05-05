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
            :list="candidates"
            v-bind="$attrs"
            class="board-column-content pt-3 overflow-y-auto flex flex-col justify-start items-center"
            :set-data="setData"
            @change="updateStage"
        >
            <div v-for="(candidate, index) in candidates" :key="index">
                <CandidateCard
                    :candidate="candidate"
                    :open-form-interview="openFormInterview"
                />
            </div>
        </draggable>
        <InterviewForm
            ref="formInterview"
            :staffs="staffs"
            :rooms="rooms"
            :mail-templates="mailTemplates"
            :submit-form="createInterviewSchedule"
        />
    </div>
</template>

<script>
    import draggable from 'vuedraggable';
    import InterviewForm from '~/components/Interview/InterviewForm/index.vue';
    import CandidateCard from '../../Candidate/CandidateCard.vue';
    import mixin from './mixin';

    export default {
        name: 'StageKanban',

        components: {
            draggable,
            CandidateCard,
            InterviewForm,
        },

        mixins: [mixin],
    };
</script>

<style lang="scss">
    @import "./style.scss";
</style>
