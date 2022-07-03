import Vue from 'vue';
import checkPermission from '~/directives/permission';

export default (context) => {
    Vue.directive('permission', {
        inserted(el, binding) {
            checkPermission(el, binding, context);
        },
        update(el, binding) {
            checkPermission(el, binding, context);
        },
    });
};
