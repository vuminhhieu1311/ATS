import _get from 'lodash/get';

export default (context, inject) => {
    inject('get', _get);
    context.$get = _get;
};
