import _map from 'lodash/map';

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
            try {
                this.candidateLoading = true;
                const { data: candidates, meta } = await
                    this.$axios.$get(`stages/${this.stage.id}/pipelines/${this.pipeline.id}/jobs/${this.jobId}/candidates?page=${this.page}`);
                candidates.forEach((candidate) => {
                    this.candidates.push(candidate);
                });
                this.totalPage = meta.lastPage;
            } catch (error) {
                //
            } finally {
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
        openInterviewForm(candidate) {
            this.$refs.createInterviewForm.open(candidate);
        },
        async createInterviewSchedule(formData) {
            // this.candidates = _map(this.candidates, (candidate) => {
            //     if (candidate.id === formData.candidate_id) {
            //         candidate.interviews.push(interviewResponse.data.data);
            //     }
            //     return candidate;
            // });
            const { data: interview } = await this.$axios.$post('interviews', {
                ...formData,
            });
            this.$refs.createInterviewForm.next(interview);
        },
        async starCandidate(candidateId) {
            try {
                const { data: candidate } = await this.$axios.$get(`candidates/${candidateId}/star`);

                this.candidates = _map(this.candidates, (item) => {
                    if (item.id === candidateId) {
                        item.isStar = candidate.isStar;
                    }

                    return item;
                });
            } catch (error) {
                this.$handleError(error);
            }
        },
    },
};
