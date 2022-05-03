import moment from 'moment';
import _map from 'lodash/map';

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
        loading: {
            type: Boolean,
            default: false,
        },
        submitForm: {
            type: Function,
            default: false,
        },
    },

    data() {
        return {
            show: false,
            isEdit: false,
            form: {
                name: null,
                date: moment().format('YYYY-MM-DD'),
                startTime: null,
                endTime: null,
                note: null,
                staffs: [],
                roomId: null,
                isOnline: false,
                isSendMail: false,
                mailTemplateId: null,
                mailTitle: '',
                mailContent: '',
                candidateId: 0,
                candidateJobId: 0,

                interview_id: '',
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
        async open(candidate, isEdit, interview) {
            this.show = true;
            this.isEdit = isEdit;
            const interviewName = `Hangout: Interview - ${this.$get(candidate, 'currentJob.name')} - ${this.$get(candidate, 'user.name')}`;
            this.form.name = this.$get(interview, 'name', interviewName);
            this.form.date = this.$get(interview, 'date', moment().format('YYYY-MM-DD'));
            this.form.startTime = this.$get(interview, 'startTime', null);
            this.form.endTime = this.$get(interview, 'endTime', null);
            this.form.note = this.$get(interview, 'note', null);
            this.form.staffs = _map(this.$get(interview, 'staffs', []), 'id');
            this.form.roomId = this.$get(interview, 'roomId', null);
            this.form.isOnline = this.$get(interview, 'isOnline', false);
            this.form.isSendMail = Boolean(this.$get(interview, 'mailTemplateId', null));
            this.form.mailTemplateId = this.$get(interview, 'mailTemplateId', null);
            this.form.mailTitle = this.$get(interview, 'mailTitle', '');
            this.form.mailContent = this.$get(interview, 'mailContent', '');
            this.form.candidateId = this.$get(candidate, 'id', 0);
            this.form.candidateJobId = this.$get(candidate, 'application.id', 0);
        },
        close() {
            this.show = false;
            this.isEdit = false;
            this.resetForm();
        },
        resetForm() {
            this.$refs.interviewForm.resetFields();
        },
        async onChangeMailTemplate(val) {
            try {
                const { data: mailTemplate } = await this.$axios.$post(`mail-templates/${val}/candidates/${this.form.candidateId}/fill-interview-mail`, {
                    startTime: this.form.startTime,
                });

                this.form.mailTitle = this.$get(mailTemplate, 'title', '');
                this.form.mailContent = this.$get(mailTemplate, 'content', '');
            } catch (error) {
                this.$handleError(error);
            }
        },
        onChangeMailContent(val) {
            this.form.mailContent = val;
        },
        handleCreateInterviewSchedule(formData) {
            this.submitForm(formData);
            this.close();
        },
    },
};
