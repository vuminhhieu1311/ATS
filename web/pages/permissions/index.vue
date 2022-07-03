<template>
    <div class="w-full">
        <PermissionList
            :permissions="permissions"
            :update-permissions="updatePermissions"
        />
    </div>
</template>

<script>
    import PermissionList from '~/components/Permission/List/index.vue';
    import { MANAGE_PERMISSION } from '~/enums/permission';

    export default {
        name: 'PermissionPage',

        components: {
            PermissionList,
        },

        middleware: 'permission',

        meta: {
            permissions: [MANAGE_PERMISSION],
        },

        async asyncData({ $axios, query }) {
            const { data: permissions } = await $axios.$get('permissions', { params: query });

            return {
                permissions,
            };
        },

        watchQuery: true,

        methods: {
            updatePermissions(permissions) {
                this.permissions = permissions;
            },
        },
    };
</script>
