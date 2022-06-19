import _find from 'lodash/find';
import _last from 'lodash/last';
import _filter from 'lodash/filter';
import _findIndex from 'lodash/findIndex';
import _map from 'lodash/map';

export default {
    props: {
        assessmentForm: Object,
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
        const addedCriteria = [];
        const criterionIds = _map(this.$get(this.assessmentForm, 'criteria', []), ({ id }) => id);
        criterionIds.forEach((id) => {
            addedCriteria.push(_find(this.criteria, (item) => item.id === id));
        });

        return {
            show: false,
            addedCriteria,
            form: {
                name: this.$get(this.assessmentForm, 'name', null),
                criterionIds,
                weights: _map(this.$get(this.assessmentForm, 'criteria', []), ({ weight }) => weight),
                assessmentFormId: this.$get(this.assessmentForm, 'id', null),
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
        openCreateCriterionForm() {
            this.$refs.createCriterionForm.open(null);
        },
        async createCriterion(formData) {
            const { data: criterion } = await this.$axios.$post('criteria', {
                ...formData,
            });
            this.criteria.unshift(criterion);
            this.$message.success(this.$t('create successfully'));
            this.$refs.createCriterionForm.close();
        },
        async updateCriterion(formData) {
            const { data: criterion } = await this.$axios.$put(`criteria/${formData.criterionId}`, {
                ...formData,
            });
            let index = _findIndex(this.criteria, ['id', formData.criterionId]);
            if (index !== -1) {
                this.criteria.splice(index, 1, criterion);
            }
            index = _findIndex(this.addedCriteria, ['id', formData.criterionId]);
            if (index !== -1) {
                this.addedCriteria.splice(index, 1, criterion);
            }
            this.$message.success(this.$t('update successfully'));
            this.$refs.editCriterionForm.close();
        },
        openEditCriterionForm(criterion) {
            this.$refs.editCriterionForm.open(criterion);
        },
        deleteCriterion(id) {
            const index = this.form.criterionIds.indexOf(id);
            if (index > -1) {
                this.form.criterionIds.splice(index, 1);
            }
        },
    },
};
