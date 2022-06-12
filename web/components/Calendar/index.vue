<template>
    <div class="grid grid-cols-10 gap-5">
        <div class="col-span-2">
            <FilterCalendar :search-interviews="searchInterviews" />
        </div>
        <div class="col-span-8">
            <FullCalendar
                :options="calendarOptions"
            />
        </div>
        <InterviewDetailModal
            ref="interviewDetailModal"
            :open-interview-form="openInterviewForm"
        />
    </div>
</template>

<script>
    import _map from 'lodash/map';
    import '@fullcalendar/core/vdom';
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import listPlugin from '@fullcalendar/list';
    import InterviewDetailModal from '~/components/Interview/DetailModal.vue';
    import FilterCalendar from './Filter.vue';

    export default {
        name: 'AppCalendar',

        components: {
            FullCalendar,
            FilterCalendar,
            InterviewDetailModal,
        },

        props: {
            interviews: {
                type: Array,
                required: true,
            },
            openInterviewForm: {
                type: Function,
                required: true,
            },
            searchInterviews: {
                type: Function,
                required: true,
            },
        },

        data(instance) {
            const events = _map(this.interviews, (interview) => ({
                id: this.$get(interview, 'id'),
                start: this.$get(interview, 'startTime'),
                end: this.$get(interview, 'endTime'),
                title: this.$get(interview, 'name'),
                backgroundColor: '#7367f0',
                borderColor: '#7367f0',
                classNames: ['pointer'],
            }));

            return {
                calendarOptions: {
                    plugins: [
                        dayGridPlugin,
                        timeGridPlugin,
                        interactionPlugin,
                        listPlugin,
                    ],
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        start: 'prev today next',
                        center: 'title',
                        end: 'dayGridMonth timeGridWeek timeGridDay listWeek',
                    },
                    locale: this.$i18n.locale,
                    buttonText: {
                        today: this.$t('today'),
                        month: this.$t('month'),
                        week: this.$t('week'),
                        day: this.$t('day'),
                        list: this.$t('list'),
                    },
                    events,
                    eventClick(info) {
                        // eslint-disable-next-line
                        const interview = instance.interviews.find((item) => item.id == info.event.id);
                        instance.$refs.interviewDetailModal.open(interview);
                    },
                },
            };
        },

        watch: {
            interviews(val) {
                this.calendarOptions.events = _map(val, (interview) => ({
                    id: this.$get(interview, 'id'),
                    start: this.$get(interview, 'startTime'),
                    end: this.$get(interview, 'endTime'),
                    title: this.$get(interview, 'name'),
                    backgroundColor: '#7367f0',
                    borderColor: '#7367f0',
                    classNames: ['pointer'],
                }));
            },
        },
    };
</script>

<style lang="scss">
    .fc-view-harness {
        background-color: theme('colors.white');
    }
    .fc-button-primary {
        background-color: theme('colors.lightPrimary') !important;
        border-color: theme('colors.primary') !important;
        color: theme('colors.primary') !important;
    }
    .fc-button-active {
        background-color: theme('colors.primary') !important;
        border-color: theme('colors.primary') !important;
        color: theme('colors.white') !important;
    }
    .fc-toolbar-title {
        font-size: 1.25em !important;
    }
    .pointer {
        cursor: pointer;
    }
</style>
