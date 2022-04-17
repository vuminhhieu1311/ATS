import {
    cleanEnv,
    str,
    url,
    host,
    port,
} from 'envalid';

const validEnv = cleanEnv(process.env, {
    APP_ENV: str({
        devDefault: 'local',
        desc: 'Application environment',
    }),
    APP_URL: url({
        default: 'http://localhost',
        desc: 'Default application url',
    }),
    APP_NAME: str({
        default: 'Base project',
        desc: 'Application name',
    }),
    HOST: host({
        default: '0.0.0.0',
        desc: 'Application host',
    }),
    PORT: port({
        default: 3000,
        desc: 'Application post',
    }),
    API_URL: str({
        default: '/api',
        desc: 'API rewrite entry point',
    }),
});

export const {
    APP_ENV,
    APP_URL,
    APP_NAME,
    HOST,
    PORT,
    API_URL,
} = validEnv;
