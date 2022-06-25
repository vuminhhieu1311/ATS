import _omit from 'lodash/omit';
import _findIndex from 'lodash/findIndex';

export default {
    props: {
        permissions: {
            type: Array,
            required: true,
        },
        updatePermissions: {
            type: Function,
            required: true,
        },
    },

    data() {
        return {
            name: this.$get(this.$route, 'query.name', null),
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
                ? { ...this.query, name: value }
                : _omit(this.query, 'name');

                this.$router.push({ query });
        },
        rowClicked(row) {
            this.permission = row;
            window.scrollTo(0, 100);
        },
        async addUsersToPermission(permissionId, userIds) {
            try {
                const { data: permission } = await this.$axios.$post(`permissions/${permissionId}/add-users`, { userIds });
                this.updatePermissionList(permission);
                this.$refs.refUsers[0].reset();
                this.$message.success(this.$t('update successfully'));
            } catch (error) {
                this.$handleError(error);
            }
        },
        async removeUsersFromPermission(permissionId, userDeletedIds) {
            try {
                const { data: permission } = await this.$axios.$post(`permissions/${permissionId}/remove-users`, { userDeletedIds });
                this.updatePermissionList(permission);
                this.$message.success(this.$t('update successfully'));
            } catch (error) {
                this.$handleError(error);
            }
        },
        async addRolesToPermission(permissionId, roleIds) {
            try {
                const { data: permission } = await this.$axios.$post(`permissions/${permissionId}/add-roles`, { roleIds });
                this.updatePermissionList(permission);
                this.$message.success(this.$t('update successfully'));
            } catch (error) {
                this.$handleError(error);
            }
        },
        async removeRolesFromPermission(permissionId, roleDeletedIds) {
            try {
                const { data: permission } = await this.$axios.$post(`permissions/${permissionId}/remove-roles`, { roleDeletedIds });
                this.updatePermissionList(permission);
                this.$message.success(this.$t('update successfully'));
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
