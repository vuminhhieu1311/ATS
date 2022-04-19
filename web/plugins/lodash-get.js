import _get from 'lodash/get';

export default (context, inject) => {
    inject('_get', _get);
    context.$_get = _get;
};
