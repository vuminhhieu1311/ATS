import _remove from 'lodash/remove';
import _find from 'lodash/find';
import _last from 'lodash/last';
import _filter from 'lodash/filter';
import _map from 'lodash/map';

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
    },

    data() {
        const currentStages = this.$get(this.pipeline, 'stages', []);

        return {
            allStages: this.stages.filter((item) => !currentStages.some((stage) => item.id === stage.id)),
            addedStages: [...currentStages],
            jobs: this.$get(this.pipeline, 'jobs', []),
            addedJobs: this.$get(this.pipeline, 'jobs', []),
            form: {
                name: this.$get(this.pipeline, 'name', null),
                stageIds: [],
                jobIds: _map(this.$get(this.pipeline, 'jobs', []), ({ id }) => id),
            },
            rules: {
                name: 'required|max:255',
            },
        };
    },

    watch: {
        // eslint-disable-next-line func-names
        'form.jobIds': function (value) {
            if (value.length > this.addedJobs.length) {
                this.addedJobs.push(_find(this.jobs, (job) => job.id === _last(value)));
            } else {
                this.addedJobs = _filter(this.addedJobs, (job) => value.includes(job.id));
            }
        },
    },

    methods: {
        onSubmitForm() {
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
        async onSearchJobs(name) {
            try {
                const { data: jobs } = await this.$axios.$get('jobs', { params: { name } });
                this.jobs = jobs;
            } catch (error) {
                this.jobs = [];
            }
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
        deleteJob(id) {
            const index = this.form.jobIds.indexOf(id);
            if (index > -1) {
                this.form.jobIds.splice(index, 1);
            }
        },
    },
};
