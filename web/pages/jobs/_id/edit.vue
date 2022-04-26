<template>
    <div>
        <h3 class="capitalize text-xl font-medium mb-8">
            {{ $t('edit job') }}
        </h3>
        <EditForm
            :job="job"
            :countries="countries"
            :loading-cities="loadingCities"
            :cities="cities"
            :on-change-country="getCitiesByCountry"
            :submit-form="submitEditForm"
        />
    </div>
</template>

<script>
    import _findIndex from 'lodash/findIndex';
    import _find from 'lodash/find';
    import EditForm from '~/components/Job/EditForm/index.vue';

    export default {
        name: 'EditJobPage',

        components: {
            EditForm,
        },

        async asyncData({ $axios, params }) {
            const { data: job } = await $axios.$get(`/jobs/${params.id}`);

            return { job };
        },

        data() {
            return {
                loadingCities: false,
                loading: false,
                cities: [],
                countries: [],
                pipelines: [],
            };
        },

        async fetch() {
            const { data: countries } = await this.$axios.$get('https://countriesnow.space/api/v0.1/countries');

            const index = _findIndex(countries, ['country', 'Vietnam']);
            const country = countries[index];
            countries.splice(index, 1);
            countries.unshift(country);

            this.countries = countries;
        },

        methods: {
            getCitiesByCountry(countryName) {
                const country = _find(this.countries, ['country', countryName]);

                this.cities = this.$get(country, 'cities', []);
            },
            async submitEditForm(formData) {
                await this.$axios.put(`/jobs/${this.job.id}`, {
                    ...formData,
                });

                this.$router.push('/jobs');
                this.$message.success(this.$t('update successfully'));
            },
        },
    };
</script>
