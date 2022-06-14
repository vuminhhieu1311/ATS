<template>
    <div class="horizontal-tabs">
        <el-tabs
            type="card"
            class="w-full mb-6 shadow-lg rounded-lg border-0"
        >
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">person</span>
                    <span>{{ $t("personal info") }}</span>
                </div>
                <BasicInfo :candidate="candidate" :submit-form="updateCandidate" />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">account_box</span>
                    <span>{{ $t("resume") }}</span>
                </div>
                <CvEmbed :candidate="candidate" />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">school</span>
                    <span>{{ $t("education") }}</span>
                </div>
                <Education
                    ref="education"
                    :candidate="candidate"
                    :submit-form="submitEducationForm"
                    :delete-education="deleteEducation"
                />
            </el-tab-pane>
            <el-tab-pane>
                <div slot="label" class="text-base flex items-center pt-2 capitalize">
                    <span class="material-icons mr-2">work</span>
                    <span>{{ $t("experience") }}</span>
                </div>
            </el-tab-pane>
        </el-tabs>
    </div>
</template>

<script>
    import BasicInfo from './BasicInfo/index.vue';
    import CvEmbed from '../CvEmbed/index.vue';
    import Education from './Education/index.vue';

    export default {
        name: 'CardDetail',

        components: {
            BasicInfo,
            CvEmbed,
            Education,
        },

        props: {
            candidate: {
                type: Object,
                required: true,
            },
            updateCandidate: {
                type: Function,
                required: true,
            },
            submitEducationForm: {
                type: Function,
                required: true,
            },
            deleteEducation: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                resume: null,
            };
        },

        methods: {
            closeEducationForm() {
                this.$refs.education.closeEducationForm();
            },
        },
    };
</script>
