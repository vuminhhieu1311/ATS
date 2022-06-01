import _assign from 'lodash/assign';
import _cloneDeep from 'lodash/cloneDeep';
import _remove from 'lodash/remove';

export default {
    props: {
        pipeline: Object,
        stages: {
            type: Array,
            required: true,
        },
        submitForm: {
            type: Function,
            required: true,
        },
        loading: {
            type: Boolean,
            default: false,
        },
    },

    data() {
        const pipeline = _cloneDeep(this.pipeline);

        return {
            form: _assign({
                name: null,
                stageIds: [],
                jobIds: [],
            }, pipeline || {}),
            rules: {
                name: 'required|max:255',
            },
            allStages: [...this.stages],
            addedStages: [],
            jobs: [],
        };
    },

    methods: {
        onCreatePipeline() {
            this.form.stageIds = this.addedStages.map(({ id }) => id);
            this.submit(this.$refs.form, this.submitForm);
        },
        addStage(stage) {
            _remove(this.allStages, (item) => item.id === stage.id);
            this.addedStages.push(stage);
        },
        removeStage(stage) {
            _remove(this.addedStages, (item) => item.id === stage.id);
            this.allStages.push(stage);
        },
        addAllStages() {
            this.addedStages = [...this.stages];
            this.allStages = [];
        },
        addNewStage(stage) {
            this.addedStages.push(stage);
        },
        async onSearchJobs() {
            // try {
            //     const { data: { data: jobs } } = await getAllJobs({ name });
            //     this.jobs = jobs;
            // } catch (error) {
            //     this.jobs = [];
            // }
        },
        resetForm() {
            this.$refs.form.resetFields();
            this.form.jobIds = [];
            this.addedStages = [];
            this.allStages = [...this.stages];
        },
        onOpenCreateStageForm() {
            this.$refs.createStageForm.open();
        },
    },
};
