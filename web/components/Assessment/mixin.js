import _find from 'lodash/find';

export default {
    props: {
        interview: {
            type: Object,
            required: true,
        },
    },

    data() {
        const staffId = this.$get(this.$auth.user, 'staff.id');
        const interviewStaffs = this.$get(this.interview, 'interviewStaffs');
        const interviewStaff = _find(interviewStaffs, ['staffId', staffId]);
        const criterionResults = this.$get(interviewStaff, 'criterionResults', []);
        const rates = criterionResults.map(({ score }) => score);
        const notes = criterionResults.map(({ note }) => note);

        return {
            activeNames: [],
            colors: ['#99A9BF', '#F7BA2A', '#FF9900'],
            form: {
                rates,
                notes,
            },
        };
    },

    methods: {
        async submitAssessmentForm(formData) {
            const { data: interview } = await this.$axios.$post(`interviews/${this.$get(this.interview, 'id')}/submit-assessment-form`, {
                ...formData,
            });
            this.$emit('updateInterview', interview);
            this.$message.success(this.$t('update successfully'));
        },
    },
};
