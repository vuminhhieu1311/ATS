import { API_URL } from './env';

export default {
    baseURL: API_URL,
    credentials: true,
    headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
    },
};
