import _map from 'lodash/map';
import moment from 'moment';
import { ADDED, REMOVE } from '~/enums/draggable-type';

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
        assessmentForms: {
            type: Array,
            required: true,
        },
        query: {
            type: Object,
            required: true,
        },
    },

    data: () => ({
        candidates: [],
        page: 1,
        totalPage: 1,
        total: 0,
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
        query() {
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
                    this.$axios.$get(`stages/${this.stage.id}/pipelines/${this.pipeline.id}/jobs/${this.jobId}/candidates`, {
                        params: {
                            ...this.query,
                            page: this.page,
                        },
                    });
                this.candidates.push(...candidates);
                this.totalPage = meta.lastPage;
                this.total = meta.total;
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
        async updateStage(val) {
            const candidateAdded = this.$get(val, `${ADDED}.element`, null);
            const candidateRemoved = this.$get(val, `${REMOVE}.element`, null);

            if (candidateAdded) {
                try {
                    this.total += 1;
                    await this.$axios.$get(`candidates/${candidateAdded.id}/stages/${this.stage.id}/move`);

                    this.candidates = _map(this.candidates, (candidate) => {
                        if (candidate.id === candidateAdded.id) {
                            candidate.updatedAt = moment();
                        }
                        return candidate;
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            }

            if (candidateRemoved) {
                this.total -= 1;
            }
        },
        openInterviewForm(candidate) {
            this.$refs.createInterviewForm.open(candidate);
        },
        async createInterviewSchedule(formData) {
            const { data: interview } = await this.$axios.$post('interviews', {
                ...formData,
            });
            this.$refs.createInterviewForm.next(interview);
            this.candidates = _map(this.candidates, (candidate) => {
                if (candidate.id === formData.candidateId) {
                    candidate.currentCandidateJob.interviews.push(interview);
                }
                return candidate;
            });
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
