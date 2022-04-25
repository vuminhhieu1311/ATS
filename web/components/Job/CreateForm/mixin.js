import TextEditor from '~/components/Shared/TextEditor.vue';
import { ALL_TYPE } from '~/enums/job/employment-type';
import { ALL_STATUS } from '~/enums/job/job-status';
import { VND, ALL_CURRENCY } from '~/enums/job/offer-currency';

export default {
    components: {
        TextEditor,
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
            jobTypes: ALL_TYPE,
            jobStatuses: ALL_STATUS,
            currencies: ALL_CURRENCY,
            form: {
                name: null,
                country: null,
                city: null,
                type: null,
                min_offer: null,
                max_offer: null,
                currency: VND,
                deadline: null,
                description: '',
                requirement: '',
                benefit: '',
                status: null,
            },
            rules: {
                name: 'required|max:255',
                country: 'required|max:255',
                city: 'required|max:255',
                status: 'required',
                type: 'required',
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
