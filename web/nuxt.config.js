import head from './config/head';

export default {
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
    ],

    // Auto import components: https://go.nuxtjs.dev/config-components
    components: true,

    // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
    buildModules: [
        // https://go.nuxtjs.dev/eslint
        '@nuxtjs/eslint-module',
        // https://go.nuxtjs.dev/tailwindcss
        '@nuxtjs/tailwindcss',
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
    ],

    // Axios module configuration: https://go.nuxtjs.dev/config-axios
    axios: {
        // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
        baseURL: '/',
    },

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
