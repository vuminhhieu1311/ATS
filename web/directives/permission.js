import _get from 'lodash/get';

export default (el, binding, context) => {
    const { value } = binding;
    const permissions = _get(context.$auth, 'user.permissionNames', []);

    if (value && value instanceof Array) {
        if (value.length > 0) {
            const checkedPermissions = value;
            const hasPermission = permissions.some((permission) => checkedPermissions.includes(permission));

            if (!hasPermission && el.parentNode) {
                el.parentNode.removeChild(el);
            }
        }
    }
};
