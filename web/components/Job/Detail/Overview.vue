<template>
    <div class="pt-10 w-full md:w-4/12 px-5">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
            <div class="px-10 -mt-20 flex-auto text-center">
                <el-avatar
                    :size="150"
                    :src="require('~/assets/images/logo-icon.png')"
                />
            </div>
            <div class="px-10 mt-5">
                <div class="pt-5 border-b">
                    <p class="text-xl font-medium capitalize">{{ $t('salary level') }}</p>
                    <div class="flex items-center py-4">
                        <span class="material-icons-outlined">payment</span>
                        <p class="ml-3 text-gray-500">{{ offer }}</p>
                    </div>
                </div>
                <div class="pt-5 border-b">
                    <p class="text-xl font-medium capitalize">{{ $t('location') }}</p>
                    <div class="flex items-center py-4">
                        <span class="material-icons-outlined">location_on</span>
                        <p class="ml-3 text-gray-500">{{ location }}</p>
                    </div>
                </div>
                <div class="pt-5 border-b">
                    <p class="text-xl font-medium capitalize">{{ $t('employment type') }}</p>
                    <div class="flex items-center py-4">
                        <span class="material-icons-outlined">category</span>
                        <p class="ml-3 text-gray-500 capitalize">{{ $get(job, 'employmentType') }}</p>
                    </div>
                </div>
                <div class="py-5 border-b">
                    <p class="text-xl font-medium capitalize">{{ $t('job tag') }}</p>
                    <div>
                        <el-tag
                            v-for="tag in $get(job, 'tags')"
                            :key="$get(tag, 'id')"
                            type="primary"
                            class="mr-3 my-2"
                        >
                            {{ $get(tag, 'name') }}
                        </el-tag>
                    </div>
                </div>
                <div class="py-5">
                    <p class="text-xl font-medium capitalize">{{ $t('deadline') }}</p>
                    <div class="flex items-center">
                        <span class="material-icons-outlined py-4">schedule</span>
                        <p class="ml-3 text-gray-500">{{ deadline }}</p>
                    </div>
                </div>
                <nuxt-link :to="{ hash:'#application-form'}">
                    <el-button
                        type="primary"
                        class="apply-btn capitalize w-full"
                    >
                        <p class="flex items-center text-2xl font-medium">
                            <span class="material-icons mr-3">add_circle</span>
                            {{ $t('apply now') }}
                        </p>
                    </el-button>
                </nuxt-link>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';

    export default {
        name: 'JobOverview',

        props: {
            job: {
                type: Object,
                required: true,
            },
        },

        computed: {
            offer() {
                const minOffer = this.$get(this.job, 'minOffer', null);
                const maxOffer = this.$get(this.job, 'maxOffer', null);
                const currency = this.$get(this.job, 'currency', null);

                if (minOffer > 0 && maxOffer > 0) {
                    return `${minOffer} ${currency} - ${maxOffer} ${currency}`;
                }
                if (!minOffer && maxOffer > 0) {
                    return `${this.$t('up to')} ${maxOffer} ${currency}`;
                }
                if (minOffer > 0 && !maxOffer) {
                    return `${this.$t('from')} ${minOffer} ${currency}`;
                }

                return this.$t('negotiable salary');
            },
            location() {
                const city = this.$get(this.job, 'city', null);
                const country = this.$get(this.job, 'country', null);

                if (city && country) {
                    return `${city} - ${country}`;
                }
                if (city) {
                    return city;
                }
                if (country) {
                    return country;
                }

                return this.$t('no data');
            },
            deadline() {
                return moment(this.$get(this.job, 'deadline')).format('DD/MM/YYYY');
            },
        },
    };
</script>

<style lang="scss" scoped>
    .apply-btn {
        padding: 15px !important;
        margin-bottom: theme('spacing.10') !important;
    }
    .el-avatar {
        border: 3px solid white;
    }
</style>
