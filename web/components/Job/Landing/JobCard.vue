<template>
    <el-card shadow="hover" class="cursor-pointer mt-5">
        <div class="flex justify-start">
            <el-avatar
                :size="100"
                :src="require('~/assets/images/logo-icon.png')"
            />
            <div class="info ml-5">
                <div class="font-semibold text-xl uppercase leading-relaxed pb-2">
                    {{ $get(job, 'name') }}
                </div>
                <div class="flex items-center pb-2">
                    <span class="material-icons-outlined text-xl mr-2">monetization_on</span>
                    {{ offer }}
                </div>
                <div class="flex items-center pb-2">
                    <span class="material-icons-outlined text-xl mr-2">location_on</span>
                    {{ location }}
                </div>
                <div class="flex items-center pb-2">
                    <span class="material-icons-outlined text-xl mr-2">schedule</span>
                    {{ $t('deadline') }}: {{ $get(job, 'deadline') }}
                </div>
            </div>
        </div>
    </el-card>
</template>

<script>
    export default {
        props: {
            job: {
                type: Object,
                required: true,
            },
        },

        computed: {
            offer() {
                const minOffer = this.$get(this.job, 'jobDetail.minOffer', null);
                const maxOffer = this.$get(this.job, 'jobDetail.maxOffer', null);

                if (minOffer > 0 && maxOffer > 0) {
                    return `${minOffer} - ${maxOffer}`;
                }
                if (!minOffer && maxOffer > 0) {
                    return `${this.$t('up to')} ${maxOffer}`;
                }
                if (minOffer > 0 && !maxOffer) {
                    return `${this.$t('from')} ${minOffer}`;
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
        },
    };
</script>
