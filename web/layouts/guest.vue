<template>
    <div>
        <Nuxt />
    </div>
</template>

<script>
    export default {
        name: 'GuestLayout',

        middleware: ['auth'],

        auth: 'guest',
    };
</script>
