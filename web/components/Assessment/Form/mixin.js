import _find from 'lodash/find';
import _last from 'lodash/last';
import _filter from 'lodash/filter';

export default {
    props: {
        criteria: {
            type: Array,
            required: true,
        },
        submitForm: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            show: false,
            addedCriteria: [],
            form: {
                name: null,
                criterionIds: [],
                weights: [],
            },
            rules: {
                name: 'required|type:string',
                criterionIds: 'name: criteria',
            },
        };
    },

    watch: {
        // eslint-disable-next-line func-names
        'form.criterionIds': function (value) {
            if (value.length > this.addedCriteria.length) {
                this.addedCriteria.push(_find(this.criteria, (item) => item.id === _last(value)));
                this.form.weights[this.addedCriteria.length - 1] = 1;
            } else {
                this.addedCriteria = _filter(this.addedCriteria, (item) => value.includes(item.id));
            }
        },
    },

    methods: {
        async open() {
            this.show = true;
        },
        close() {
            this.show = false;
            this.resetForm();
        },
        resetForm() {
            this.$refs.form.resetFields();
            this.form.criterionIds = [];
            this.form.weights = [];
        },
    },
};
