<template>
    <div class="w-full">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-8/12 pr-8">
                <CardDetail
                    ref="cardDetail"
                    :candidate="candidate"
                    :update-candidate="updateCandidate"
                    :submit-education-form="submitEducationForm"
                    :delete-education="deleteEducation"
                    :submit-experience-form="submitExperienceForm"
                    :delete-experience="deleteExperience"
                />
            </div>
            <div class="w-full lg:w-4/12">
                <CardSummary :candidate="candidate" />
            </div>
        </div>
    </div>
</template>

<script>
    import _findIndex from 'lodash/findIndex';
    import CardDetail from '~/components/Candidate/Detail/CardDetail/index.vue';
    import CardSummary from '~/components/Candidate/Detail/CardSummary/index.vue';

    export default {
        name: 'CandidateDetailPage',

        components: {
            CardDetail,
            CardSummary,
        },

        async asyncData({ $axios, params }) {
            const { data: candidate } = await $axios.$get(`candidates/${params.id}`);

            return { candidate };
        },

        methods: {
            async updateCandidate(formData) {
                const { data: candidate } = await this.$axios.$put(`candidates/${this.$get(this.candidate, 'id')}`, formData);
                this.candidate = candidate;
                this.$message.success(this.$t('update successfully'));
            },
            async submitEducationForm(formData) {
                if (formData.educationId) {
                    const { data: education } = await this.$axios.$put(`education/${formData.educationId}`, {
                        ...formData,
                    });
                    const index = _findIndex(this.candidate.education, ['id', formData.educationId]);
                    if (index !== -1) {
                        this.candidate.education.splice(index, 1, education);
                    }
                    this.$message.success(this.$t('update successfully'));
                } else {
                    const { data: education } = await this.$axios.$post(`candidates/${this.candidate.id}/education`, {
                        ...formData,
                    });
                    this.candidate.education.unshift(education);
                    this.$message.success(this.$t('create successfully'));
                }
                this.$refs.cardDetail.closeEducationForm();
            },
            async deleteEducation(educationId) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete education'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        await this.$axios.$delete(`education/${educationId}`);
                        this.candidate.education = this.candidate.education.filter((item) => item.id !== educationId);
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
            async submitExperienceForm(formData) {
                if (formData.experienceId) {
                    const { data: experience } = await this.$axios.$put(`experiences/${formData.experienceId}`, {
                        ...formData,
                    });
                    const index = _findIndex(this.candidate.experiences, ['id', formData.experienceId]);
                    if (index !== -1) {
                        this.candidate.experiences.splice(index, 1, experience);
                    }
                    this.$message.success(this.$t('update successfully'));
                } else {
                    const { data: experience } = await this.$axios.$post(`candidates/${this.candidate.id}/experiences`, {
                        ...formData,
                    });
                    this.candidate.education.unshift(experience);
                    this.$message.success(this.$t('create successfully'));
                }
                this.$refs.cardDetail.closeExperienceForm();
            },
            async deleteExperience(experienceId) {
                try {
                    this.$confirm(this.$t('do you want to delete?'), this.$t('delete experience'), {
                        confirmButtonText: this.$t('confirm'),
                        cancelButtonText: this.$t('cancel'),
                        type: 'warning',
                    }).then(async () => {
                        await this.$axios.$delete(`experiences/${experienceId}`);
                        this.candidate.experiences = this.candidate.experiences.filter(
                            (item) => item.id !== experienceId,
                        );
                        this.$message.success(this.$t('delete successfully'));
                    });
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
