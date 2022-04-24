import _assign from 'lodash/assign';
import _map from 'lodash/map';
import TextEditor from '~/components/Shared/TextEditor.vue';

export default {
    components: {
        TextEditor,
    },
    props: {
        job: Object,
        pipelines: {
            type: Array,
            required: true,
        },
        countries: {
            type: Array,
            required: true,
        },
        cities: {
            type: Array,
            required: true,
        },
        loadingCities: {
            type: Boolean,
            required: true,
        },
        onChangeCountry: {
            type: Function,
            required: true,
        },
        submitForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            active: 0,
            // jobTypes: ALL_TYPE,
            // jobStatuses: ALL_STATUS,
            // jobCurrencies: ALL_CURRENCY,
            form: _assign({
                name: null,
                pipeline_id: this.$get(this.job, 'pipeline.id', null),
                country: null,
                city: null,
                isRemote: false,
                type: null,
                status: null,
                tags_name: _map(this.$get(this.job, 'tags', []), 'name'),
                min_offer: this.$get(this.job, 'jobDetail.minOffer', null),
                max_offer: this.$get(this.job, 'jobDetail.maxOffer', null),
                deadline: this.$get(this.job, 'jobDetail.deadline', null),
                description: this.$get(this.job, 'jobDetail.description', ''),
                requirement: this.$get(this.job, 'jobDetail.requirement', ''),
                benefit: this.$get(this.job, 'jobDetail.benefit', ''),
                // currency: this.$get(this.job, 'jobDetail.currency', VND),
            }, this.job || {}),
            rules: {
                name: 'required|max:255',
                pipeline_id: 'name: pipeline|required',
                country: 'required|max:255',
                city: 'required|max:255',
                status: 'required',
                type: 'required',
            },
        };
    },

    methods: {
        changeCountry(val) {
            this.form.country = val;
            this.onChangeCountry(val);
        },
        onChangePipeline(val) {
            this.form.pipeline_id = val;
        },
        onChangeRequirement(val) {
            this.form.requirement = val;
        },
        onChangeBenefit(val) {
            this.form.benefit = val;
        },
        onChangeDescription(val) {
            this.form.description = val;
        },
        resetForm() {
            this.$refs.form.resetFields();
        },
        handleCommand(status) {
            this.form.status = status;
            this.submit(this.$refs.form, this.submitForm);
        },
        changeType(val) {
            this.form.type = val;
        },
        changeCurrency(val) {
            this.form.currency = val;
        },
        propStep() {
            this.step = !this.step;
        },
    },
};
