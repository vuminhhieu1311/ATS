import _get from 'lodash/get';
import { Message } from 'element-ui';

export default (context, inject) => {
    const handleError = (error, callback = null) => {
        if (process.env.APP_ENV !== 'production') {
            // eslint-disable-next-line no-console
            console.log(error);
        }
        Message.closeAll();
        Message.error(_get(error.response, 'data.message', context.app.i18n.t('Sorry, something went wrong')));
        if (typeof callback === 'function') {
            callback(error);
        }
    };
    // Inject $handleError(error) in Vue, context and store.
    inject('handleError', handleError);
    context.$handleError = handleError;
};
