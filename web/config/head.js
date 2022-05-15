export default {
    title: process.env.APP_NAME || '',
    meta: [
        { charset: 'utf-8' },
        { name: 'viewport', content: 'width=device-width, initial-scale=1' },
        { hid: 'description', name: 'description', content: '' },
        { name: 'format-detection', content: 'telephone=no' },
    ],
    link: [
        { rel: 'icon', type: 'image/x-icon', href: '/favicon.png' },
        {
            rel: 'stylesheet',
            href: 'https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap',
        },
        {
            rel: 'stylesheet',
            href: 'https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined',
        },
    ],
};
