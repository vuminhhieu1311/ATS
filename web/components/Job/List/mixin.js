import moment from 'moment';

export default {
    props: {
        jobs: {
            type: Array,
            required: true,
        },
        meta: {
            type: Object,
            required: true,
        },
        deleteJob: {
            type: Function,
            required: true,
        },
    },

    methods: {
        offer(job) {
            const minOffer = this.$get(job, 'minOffer', null);
            const maxOffer = this.$get(job, 'maxOffer', null);
            const currency = this.$get(job, 'currency', null);

            if (minOffer > 0 && maxOffer > 0) {
                return `${minOffer} - ${maxOffer} (${currency})`;
            }
            if (!minOffer && maxOffer > 0) {
                return `${this.$t('up to')} ${maxOffer} (${currency})`;
            }
            if (minOffer > 0 && !maxOffer) {
                return `${this.$t('from')} ${minOffer} (${currency})`;
            }

            return this.$t('no data');
        },
        formatDate(date) {
            if (date) {
                return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
            }

            return null;
        },
    },
};
