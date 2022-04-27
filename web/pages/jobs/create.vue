<template>
    <div>
        <h3 class="capitalize text-xl font-medium mb-8">
            {{ $t('create job') }}
        </h3>
        <CreateForm
            :countries="countries"
            :cities="cities"
            :on-change-country="getCitiesByCountry"
            :submit-form="submitCreateForm"
        />
    </div>
</template>

<script>
    import _findIndex from 'lodash/findIndex';
    import _find from 'lodash/find';
    import CreateForm from '~/components/Job/CreateForm/index.vue';

    export default {
        name: 'CreateJobPage',

        components: {
            CreateForm,
        },

        data() {
            return {
                cities: [],
                countries: [],
            };
        },

        async fetch() {
            try {
                const { data: countries } = await this.$axios.$get('https://countriesnow.space/api/v0.1/countries');

                const index = _findIndex(countries, ['country', 'Vietnam']);
                const country = countries[index];
                countries.splice(index, 1);
                countries.unshift(country);

                this.countries = countries;
            } catch (error) {
                this.$handleError(error);
            }
        },

        methods: {
            getCitiesByCountry(countryName) {
                const country = _find(this.countries, ['country', countryName]);

                this.cities = this.$get(country, 'cities', []);
            },
            async submitCreateForm(formData) {
                await this.$axios.$post('jobs', {
                    ...formData,
                });
                this.$router.push('/jobs');
                this.$message.success(this.$t('create successfully'));
            },
        },
    };
</script>
