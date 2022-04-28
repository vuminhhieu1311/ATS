export default {
    props: {
        stage: {
            type: Object,
            required: true,
        },
        pipeline: {
            type: Object,
            required: true,
        },
        jobId: {
            type: Number,
            required: true,
        },
    },

    data: () => ({
        candidates: [],
        page: 1,
        totalPage: 1,
        candidateLoading: false,
    }),

    watch: {
        jobId() {
            this.page = 1;
            this.candidates = [];
            this.fetch();
            this.page += 1;
        },
        pipeline() {
            this.page = 1;
            this.candidates = [];
            this.fetch();
            this.page += 1;
        },
    },

    methods: {
        handleShowInterviews(candidateId) {
            this.showCandidateInterviews(this.$get(this.stage, 'id'), candidateId);
        },
        async fetch() {
            this.candidateLoading = true;
            try {
                const { data: candidates, meta } = await
                    this.$axios.$get(`stages/${this.stage.id}/pipelines/${this.pipeline.id}/jobs/${this.jobId}/candidates?page=${this.page}`);
                candidates.forEach((candidate) => {
                    this.candidates.push(candidate);
                });
                this.totalPage = meta.lastPage;
                this.candidateLoading = false;
            } catch (error) {
                this.candidateLoading = false;
            }
        },
        setData(dataTransfer) {
            // to avoid Firefox bug
            // Detail see : https://github.com/RubaXa/Sortable/issues/1012
            dataTransfer.setData('Text', '');
        },
        load() {
            if (this.page <= this.totalPage) {
                this.fetch();
                this.page += 1;
            }
        },
        updateStage() {
            // const candidateAdded = this.$get(val, `${ADDED}.element`, null);
            // const candidateRemoved = this.$get(val, `${REMOVE}.element`, null);

            // if (candidateAdded) {
            //     this.$emit('stageChanged', {
            //         candidate: candidateAdded,
            //         stage: this.stage,
            //     });
            // }

            // if (candidateRemoved) {
            //     this.$emit('candidateRemoved', {
            //         candidateRemoved,
            //         stage: this.stage,
            //     });
            // }
        },
        openFormInterview(candidate) {
            const interview = '';
            const isEdit = false;
            this.$refs.formInterview.open(candidate, isEdit, interview);
        },
        // async submitInterviewForm(formData) {
        //     try {
        //         this.loading = true;
        //         const interviewResponse = await createInterviewSchedule(formData.candidate_stage_id, {
        //             subject: formData.subject,
        //             start_date: formData.start_date,
        //             end_date: formData.end_date,
        //             note: formData.note,
        //             service_id: formData.service_id,
        //             mail_template_id: formData.mail_template_id,
        //             notification_template_id: formData.notification_template_id,
        //             staff_id: formData.interviewer,
        //             notice_before_interview: formData.notice_before_interview,
        //             interviewer_notice_service: formData.interviewer_notice_service,
        //         });
        //         this.loading = false;
        //         this.candidates = _map(this.candidates, (candidate) => {
        //             if (candidate.id === formData.candidate_id) {
        //                 candidate.interviews.push(interviewResponse.data.data);
        //             }
        //             return candidate;
        //         });
        //         this.$message.success(this.$t('messages.set_interview'));
        //     } catch (error) {
        //         this.$handleError(error);
        //     }
        // },
    },
};
