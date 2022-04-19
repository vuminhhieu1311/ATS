import { BACKEND_URL } from './env';

export default {
    strategies: {
        laravelSanctum: {
            provider: 'laravel/sanctum',
            url: BACKEND_URL,
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
