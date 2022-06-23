import _omit from 'lodash/omit';
import _findIndex from 'lodash/findIndex';

export default {
    props: {
        permissions: {
            type: Array,
            required: true,
        },
        meta: {
            type: Object,
            required: true,
        },
        updatePermissions: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            permissionName: this.$get(this.$route, 'query.permissionName', null),
            currentTab: 'Users',
            tabs: ['Users', 'Roles'],
            permission: {},
        };
    },

    computed: {
        currentTabComponent() {
            return `${this.currentTab}Tab`;
        },
    },

    methods: {
        onSearchPermissions(value) {
            const query = value
                ? { ...this.query, permissionName: value }
                : _omit(this.query, 'permissionName');

                this.$router.push({ query });
        },
        rowClicked(row) {
            this.permission = row;
            window.scrollTo(0, 100);
        },
        async addUsersToPermission(permissionId, userIds) {
            try {
                console.log(permissionId);
                console.log(userIds);
                // const { data: { data: permission } } = await addUsersToPermission(permissionId, { userIds });
                // this.updatePermissionList(permission);
                // this.$refs.refUsers[0].reset();
                // this.$message.success(this.$t('messages.update_successfully'));
            } catch (error) {
                this.$handleError(error);
            }
        },
        async removeUsersFromPermission(permissionId, userDeletedIds) {
            try {
                console.log(permissionId);
                console.log(userDeletedIds);
                // const { data: { data: permission } } = await removeUsersFromPermission(
                //     permissionId,
                //     { userDeletedIds },
                // );
                // this.updatePermissionList(permission);
                // this.$message.success(this.$t('messages.update_successfully'));
            } catch (error) {
                this.$handleError(error);
            }
        },
        updatePermissionList(permission) {
            this.permission = permission;
            const permissions = this.permissions;
            permissions.forEach((element, i) => {
                if (element.id === permission.id) {
                    permissions[i] = permission;
                } else {
                    const index = _findIndex(element.children, ['id', permission.id]);
                    if (index !== -1) {
                        element.children.splice(index, 1, permission);
                    }
                }
            });
            this.updatePermissions(permissions);
        },
    },
};
