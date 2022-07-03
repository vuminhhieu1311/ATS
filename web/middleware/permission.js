import _get from 'lodash/get';

export default ({ $auth, route, error }) => {
    const permissions = _get($auth, 'user.permissionNames', []);

    return route.meta.map((meta) => {
        if (meta.permissions && typeof meta.permissions !== 'undefined') {
            const checkedPermissions = meta.permissions;
            const hasPermission = permissions.some((permission) => checkedPermissions.includes(permission));
            if (!hasPermission) {
                error({ statusCode: 404, message: 'This Page Could Not Be Found' });
            }
        }

        return true;
    });
};
