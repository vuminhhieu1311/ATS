<template>
    <div>
        <Calendar :interviews="interviews" :open-interview-form="openInterviewForm" />
        <InterviewForm
            ref="interviewForm"
            :staffs="staffs"
            :rooms="rooms"
            :mail-templates="mailTemplates"
        />
    </div>
</template>

<script>
    import Calendar from '~/components/Calendar/index.vue';
    import InterviewForm from '~/components/Interview/InterviewForm/index.vue';

    export default {
        name: 'CalendarPage',

        components: {
            Calendar,
            InterviewForm,
        },

        async asyncData({ $axios, query }) {
            const { data: interviews } = await $axios.$get('interviews', { params: query });

            return {
                interviews,
            };
        },

        data() {
            return {
                staffs: [],
                rooms: [],
                mailTemplates: [],
            };
        },

        async fetch() {
            const [
                { data: staffs },
                { data: rooms },
                { data: mailTemplates },
            ] = await Promise.all([
                await this.$axios.$get('staffs'),
                await this.$axios.$get('rooms'),
                await this.$axios.$get('mail-templates'),
            ]);

            this.staffs = staffs;
            this.rooms = rooms;
            this.mailTemplates = mailTemplates;
        },

        methods: {
            openInterviewForm(interview) {
                this.$refs.interviewForm.open(this.$get(interview, 'candidateJob.candidate'), true, interview);
            },
        },
    };
</script>
