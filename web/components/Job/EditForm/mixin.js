import _find from 'lodash/find';
import _findIndex from 'lodash/findIndex';
import TextEditor from '~/components/Shared/TextEditor.vue';
import { ALL_TYPE } from '~/enums/job/employment-type';
import { ALL_STATUS } from '~/enums/job/job-status';
import { VND, ALL_CURRENCY } from '~/enums/job/offer-currency';
import SaveAsButton from './SaveAsButton.vue';

export default {
    components: {
        TextEditor,
        SaveAsButton,
    },

    props: {
        job: {
            type: Object,
            required: true,
        },
        submitForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            jobTypes: ALL_TYPE,
            jobStatuses: ALL_STATUS,
            currencies: ALL_CURRENCY,
            countries: [],
            cities: [],
            form: {
                name: this.$get(this.job, 'name', null),
                country: this.$get(this.job, 'country', null),
                city: this.$get(this.job, 'city', null),
                employmentType: this.$get(this.job, 'employmentType', null),
                minOffer: this.$get(this.job, 'minOffer', null),
                maxOffer: this.$get(this.job, 'maxOffer', null),
                currency: this.$get(this.job, 'currency', VND),
                deadline: this.$get(this.job, 'deadline', null),
                description: this.$get(this.job, 'description') ? this.$get(this.job, 'description') : '',
                requirement: this.$get(this.job, 'requirement') ? this.$get(this.job, 'requirement') : '',
                benefit: this.$get(this.job, 'benefit') ? this.$get(this.job, 'benefit') : '',
                status: this.$get(this.job, 'status', null),
            },
            rules: {
                name: 'required|max:255|type:string',
                country: 'required|max:255|type:string',
                city: 'required|max:255|type:string',
                employmentType: 'name: employment type|required|type:string',
                minOffer: 'name: min offer',
                maxOffer: 'name: max offer',
                status: 'required|type:string',

            },
        };
    },

    async fetch() {
        const { data: countries } = await this.$axios.$get('https://countriesnow.space/api/v0.1/countries');

        const index = _findIndex(countries, ['country', 'Vietnam']);
        const country = countries[index];
        countries.splice(index, 1);
        countries.unshift(country);

        this.countries = countries;
        this.getCitiesByCountry(this.form.country);
    },

    methods: {
        handleCommand(status) {
            this.form.status = status;
            this.submit(this.$refs.form, this.submitForm);
        },
        onChangeValue(key, value) {
            this.form[key] = value;
        },
        getCitiesByCountry(countryName) {
            const country = _find(this.countries, ['country', countryName]);
            this.cities = this.$get(country, 'cities', []);
        },
    },
};
