<template>
    <div v-loading="true" />
</template>

<script>
    export default {
        name: 'CallbackPage',

        layout: 'callback',

        mounted() {
            this.$auth.loginWith('laravelSanctum');

            if (this.$auth.user) {
                this.$router.push('/');
            }
        },
    };
</script>
