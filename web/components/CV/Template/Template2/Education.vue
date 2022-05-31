<template>
    <div class="resume_item resume_education">
        <div class="title">
            <p class="bold">
                Education
            </p>
        </div>
        <ul>
            <li
                v-for="education in $get($auth.user, 'candidate.education', [])"
                :key="education.id"
            >
                <div class="date">{{ getDate(education) }}</div>
                <div class="info">
                    <h4>{{ $get(education, 'school_name') }}</h4>
                    <div style="margin-bottom: 10px;">
                        {{ $get(education, 'field_of_study') }} - {{ $get(education, 'grade') }}
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'EducationPart',

        methods: {
            getDate(education) {
                const startDate = moment(this.$get(education, 'start_date')).format('DD/MM/YYYY');
                const endDate = education.end_date ? moment(education.end_date).format('DD/MM/YYYY') : 'Now';

                return `${startDate} - ${endDate}`;
            },
        },
    };
</script>
