import TextEditor from '~/components/Shared/TextEditor.vue';
import { ALL_TYPE } from '~/enums/job/employment-type';
import { ALL_STATUS } from '~/enums/job/job-status';
import { VND, ALL_CURRENCY } from '~/enums/job/offer-currency';
import NextButton from './NextButton.vue';
import PrevButton from './PrevButton.vue';
import Step from './Step.vue';

export default {
    components: {
        TextEditor,
        NextButton,
        PrevButton,
        Step,
    },

    props: {
        countries: {
            type: Array,
            required: true,
        },
        cities: {
            type: Array,
            required: true,
        },
        pipelines: {
            type: Array,
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
            jobTypes: ALL_TYPE,
            jobStatuses: ALL_STATUS,
            currencies: ALL_CURRENCY,
            form: {
                name: null,
                country: null,
                city: null,
                employmentType: null,
                minOffer: null,
                maxOffer: null,
                currency: VND,
                deadline: null,
                description: '',
                requirement: '',
                benefit: '',
                pipelineId: null,
                status: null,
            },
            rules: {
                name: 'required|max:255|type:string',
                country: 'required|max:255|type:string',
                city: 'required|max:255|type:string',
                employmentType: 'name:employment type|required|type:string',
                minOffer: 'name:min offer',
                maxOffer: 'name:max offer',
                pipelineId: 'name:pipeline|required|type:integer',
                status: 'required|type:string',
            },
        };
    },

    methods: {
        handleCommand(status) {
            this.form.status = status;
            this.submit(this.$refs.form, this.submitForm);
        },
        next() {
            if (this.active < 2) {
                this.active += 1;
            }
        },
        prev() {
            if (this.active > 0) {
                this.active -= 1;
            }
        },
        onChangeValue(key, value) {
            this.form[key] = value;
        },
    },
};
