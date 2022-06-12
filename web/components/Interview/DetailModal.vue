<template>
    <el-drawer
        ref="drawer"
        :title="$get(interview, 'name')"
        :visible.sync="show"
        direction="rtl"
        size="40%"
    >
        <div class="px-5">
            <InterviewInfo :interview="interview" />
            <div class="my-5">
                <el-button
                    type="primary"
                    @click="openInterviewForm(interview)"
                >
                    <span class="material-icons-outlined mr-2">mode_edit</span>
                    {{ $t('edit interview') }}
                </el-button>
                <el-button
                    @click="submit($refs.form, submitForm)"
                >
                    <span class="material-icons-outlined mr-2">event_busy</span>
                    {{ $t('cancel schedule') }}
                </el-button>
            </div>
        </div>
    </el-drawer>
</template>
<script>
    import InterviewInfo from './Detail/InterviewInfo.vue';

    export default {
        name: 'InterviewDetailModal',

        components: {
            InterviewInfo,
        },

        props: {
            openInterviewForm: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                show: false,
                interview: {},
            };
        },

        methods: {
            open(interview) {
                this.show = true;
                this.interview = interview;
            },
        },
    };
</script>
