import head from './config/head';
import axios from './config/axios';
import auth from './config/auth';

require('dotenv').config();

export default {
    server: {
        host: '0',
    },

    ssr: false,

    // Global page headers: https://go.nuxtjs.dev/config-head
    head,

    // Global CSS: https://go.nuxtjs.dev/config-css
    css: [
        'element-ui/lib/theme-chalk/index.css',
        '~/assets/scss/app.scss',
        '~/assets/scss/override.scss',
    ],

    // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
    plugins: [
        '@/plugins/element-ui',
        '@/plugins/nuxt-client-init',
        '@/plugins/lodash-get',
        '@/plugins/handle-error',
        '@/plugins/vue-avatar',
    ],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        // https://go.nuxtjs.dev/eslint
        '@nuxtjs/eslint-module',
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',
        '@nuxtjs/dotenv',
    ],

    // Modules: https://go.nuxtjs.dev/config-modules
    modules: [
        // https://go.nuxtjs.dev/axios
        '@nuxtjs/axios',
        [
            '@nuxtjs/i18n',
            {
                langDir: '~/locales/',
                locales: [
                    { code: 'en', file: 'en.json' },
                    { code: 'vi', file: 'vi.json' },
                ],
                defaultLocale: 'en',
                vueI18n: {
                    fallbackLocale: 'en',
                },
            },
        ],
        '@nuxtjs/auth-next',
    ],

    axios,

    auth,

    // Build Configuration: https://go.nuxtjs.dev/config-build
    build: {
        transpile: [/^element-ui/],
        loaders: {
            scss: {
                sassOptions: {
                    quietDeps: true,
                },
            },
        },
    },
};
