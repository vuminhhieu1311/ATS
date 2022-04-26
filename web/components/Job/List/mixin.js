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
    },

    methods: {
        // async deleteJob(id) {
        //     this.$confirm(this.$t('ask_delete'), 'Warning', {
        //         confirmButtonText: this.$t('ok'),
        //         cancelButtonText: this.$t('cancel'),
        //         type: 'warning',
        //     }).then(() => {
        //         this.$emit('handleDelete', id);
        //     });
        // },
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
