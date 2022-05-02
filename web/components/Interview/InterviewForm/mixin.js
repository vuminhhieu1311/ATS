import moment from 'moment';
import { map } from 'lodash';

export default {
    props: {
        rooms: {
            type: Array,
            required: true,
        },
        staffs: {
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
            isEdit: false,
            show: false,
            job: null,
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

                candidate_id: '',
                stage_id: '',
                interview_id: '',
            },
            rules: {
                name: 'required|max:255',
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
            const candidateId = candidate.id;
            this.show = true;
            this.form.candidate_id = candidateId;
            this.form.candidate_stage_id = this.$get(candidate, 'currentCandidateStage.id', 0);
            if (isEdit) {
                this.form.subject = interview.subject;
                this.form.date = interview.date;
                this.form.start_date = interview.startDate;
                this.form.end_date = interview.endDate;
                this.form.interviewer = map(interview.interviewers, 'staffId');
                this.form.send_mail = interview.isSendMail;
                this.form.edit_mail = interview.isSendMail;
                this.form.mail_template_id = interview.mail_template_id;
                this.form.note = interview.note;
                this.form.interview_id = interview.id;
                this.isEdit = isEdit;
                this.job = interview.job;
            } else {
                this.form.name = `Hangout: Interview - ${candidate.job.name} - ${candidate.name}`;
                this.form.date = moment().format('YYYY-MM-DD');
                this.form.start_date = '';
                this.form.end_date = '';
                this.form.interviewer = '';
                this.form.send_mail = false;
                this.formInterview.mail_template_id = '';
                this.formInterview.note = '';
                this.formInterview.interview_id = '';
                this.isEdit = false;
                this.job = null;
            }
        },
        onClose() {
            this.isEdit = false;
            this.show = false;
            this.resetForm();
        },
        resetForm() {
            this.$refs.interviewForm.resetFields();
        },
        handleSubmitForm(formData) {
            this.submitForm(formData);
            this.onClose();
        },
    },
};
