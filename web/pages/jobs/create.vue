<template>
    <div>
        <h3 class="capitalize text-xl font-medium mb-8">
            {{ $t('create job') }}
        </h3>
        <CreateForm
            :countries="countries"
            :loading-cities="loadingCities"
            :cities="cities"
            :on-change-country="getCitiesByCountry"
            :submit-form="submitCreateForm"
        />
    </div>
</template>

<script>
    import _findIndex from 'lodash/findIndex';
    import CreateForm from '~/components/Job/CreateForm/index.vue';

    export default {
        name: 'CreateJobPage',

        components: {
            CreateForm,
        },

        data() {
            return {
                loadingCities: false,
                cities: [],
                countries: [],
            };
        },

        async fetch() {
            try {
                const { data: countries } = await this.$axios.$get('https://countriesnow.space/api/v0.1/countries/currency');

                const index = _findIndex(countries, ['name', 'Vietnam']);
                const country = countries[index];
                countries.splice(index, 1);
                countries.unshift(country);

                this.countries = countries;
            } catch (error) {
                this.$handleError(error);
            }
        },

        methods: {
            async getCitiesByCountry(country) {
                this.loadingCities = true;
                this.cities = [];
                try {
                    const { data: cities } = await this.$axios.$post('https://countriesnow.space/api/v0.1/countries/cities', { country });
                    this.cities = cities;
                    this.loadingCities = false;
                } catch (error) {
                    this.loadingCities = false;
                    this.$handleError(error);
                }
            },
            async submitCreateForm() {
                // await createJob({
                //     is_remote: formData.isRemote,
                //     ...formData,
                // });
                // this.$router.push('/jobs');
                // this.$message.success(this.$t('messages.create_job'));
            },
        },
    };
</script>
