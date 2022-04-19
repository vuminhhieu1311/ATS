<template>
    <div class="h-screen w-full flex items-center justify-center">
        <img
            src="@/assets/images/logo.png"
            alt="Logo"
            class="logo absolute left-0 top-0 mt-4 ml-4"
        >
        <div class="2xl:w-2/3 xl:w-2/3 lg:w-2/3 md:w-1/2 sm:w-0 text-center">
            <el-image :src="require('~/assets/images/login.svg')" alt="login" class="login-image" />
        </div>
        <div class="2xl:w-1/3 xl:w-1/3 lg:w-1/3 md:w-1/2 sm:w-full h-screen bg-white flex justify-center items-center">
            <LoginForm />
        </div>
    </div>
</template>

<script>
    import LoginForm from '~/components/Authentication/LoginForm/index.vue';

    export default {
        name: 'LoginPage',

        components: {
            LoginForm,
        },

        layout: 'guest',
    };
</script>

<style lang="scss">
    .login-image {
        height: 70%;
        width: 70%;
    }

    .logo {
        height: theme('spacing.20');
    }

    .form-input {
        margin-bottom: theme('spacing.4') !important;
    }

    .social-icon {
        height: 35px;
        width: 35px;
    }
</style>
