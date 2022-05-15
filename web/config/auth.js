export default {
    strategies: {
        laravelSanctum: {
            provider: 'laravel/sanctum',
            url: process.env.BACKEND_URL,
            endpoints: {
                login: {
                    url: '/api/login',
                },
                logout: {
                    url: '/api/logout',
                },
                user: {
                    url: '/api/user',
                },
            },
        },
    },
    redirect: {
        login: '/login',
        logout: '/login',
        home: '/',
    },
};
