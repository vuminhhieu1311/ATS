import moment from 'moment';

export default {
    props: {
        staffs: {
            type: Array,
            required: true,
        },
        rooms: {
            type: Array,
            required: true,
        },
        mailTemplates: {
            type: Array,
            required: true,
        },
        assessmentForms: {
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
            candidate: {},
            step: true,
            interview: {},
            form: {
                name: null,
                date: moment().format('YYYY-MM-DD'),
                startTime: null,
                endTime: null,
                note: null,
                staffs: [],
                roomId: null,
                isOnline: false,
                assessmentFormId: null,
                candidateId: 0,
                candidateJobId: 0,
            },
            rules: {
                name: 'required|max:255',
                staffs: 'name: interviewers|required',
                date: 'required',
                startTime: 'name:start time|required',
                endTime: 'name:end time|required',
            },
        };
    },

    watch: {
        // eslint-disable-next-line func-names
        'form.date': function (val) {
            if (val) {
                const startTime = moment(this.form.startTime).format('HH:mm:ss');
                const endTime = moment(this.form.endTime).format('HH:mm:ss');
                this.form.startTime = moment(`${val} ${startTime}`, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
                this.form.endTime = moment(`${val} ${endTime}`, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD HH:mm:ss');
            }
        },
        // eslint-disable-next-line func-names
        'form.startTime': function (val) {
            if (val) {
                this.form.endTime = moment(val, 'YYYY-MM-DD HH:mm:ss').add(60, 'minutes').format('YYYY-MM-DD HH:mm:ss');
            }
        },
    },

    methods: {
        async open(candidate) {
            this.show = true;
            this.candidate = candidate;
            this.form.name = `Interview - ${this.$get(candidate, 'currentJob.name')} - ${this.$get(candidate, 'user.name')}`;
            this.form.candidateId = this.$get(candidate, 'id', 0);
            this.form.candidateJobId = this.$get(candidate, 'application.id', 0);
        },
        close() {
            this.show = false;
            this.step = true;
        },
        resetForm() {
            this.$refs.form.resetFields();
            this.form.roomId = null;
        },
        next(interview) {
            this.resetForm();
            this.interview = interview;
            this.step = false;
        },
    },
};
