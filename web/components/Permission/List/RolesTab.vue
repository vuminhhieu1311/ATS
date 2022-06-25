<template>
    <div v-if="permissionClicked">
        <p class="mb-3">{{ $t('permission') }}: {{ $get(permission, 'name') }}</p>
        <div class="flex items-center">
            <el-select
                v-model="roleIds"
                size="small"
                multiple
                class="w-full my-2"
                filterable
                :placeholder="$t('search roles')"
            >
                <el-option
                    v-for="role in roles"
                    :key="$get(role, 'id')"
                    :label="$get(role, 'name')"
                    :value="$get(role, 'id')"
                />
            </el-select>
            <div class="ml-2">
                <el-button
                    type="primary"
                    class="add-user-btn capitalize"
                    size="mini"
                    @click="handleAddRoles"
                >
                    <span class="material-icons text-lg mr-1">add</span>
                    <span class="text-sm">{{ $t('add') }}</span>
                </el-button>
            </div>
        </div>
        <div v-if="permission.roles.length">
            <el-table
                ref="multipleTable"
                :data="permission.roles"
                style="width: 100%"
                @selection-change="handleSelectRoles"
            >
                <el-table-column type="selection" width="50" />
                <el-table-column width="70">
                    <template slot-scope="{ row }">
                        <vue-avatar
                            :username="row.name"
                            :size="40"
                        />
                    </template>
                </el-table-column>
                <el-table-column>
                    <template slot-scope="{ row }">
                        <p class="font-semibold">{{ row.name }}</p>
                    </template>
                </el-table-column>
            </el-table>
            <div class="mt-5">
                <el-button
                    type="primary"
                    class="capitalize"
                    size="mini"
                    @click="handleRemoveRoles"
                >
                    {{ $t('remove') }}
                </el-button>
            </div>
        </div>
    </div>
</template>

<script>
    import _map from 'lodash/map';
    import _isEmpty from 'lodash/isEmpty';

    export default {
        props: {
            permission: {
                type: Object,
                required: true,
            },
            addRolesToPermission: {
                type: Function,
                required: true,
            },
            removeRolesFromPermission: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                roleIds: _map(this.$get(this.permission, 'roles', []), 'id'),
                roles: [],
                roleDeletedIds: [],
            };
        },

        async fetch() {
            const { data: roles } = await this.$axios.$get('roles');
            this.roles = roles;
        },

        computed: {
            permissionClicked() {
                return !_isEmpty(this.permission);
            },
        },

        watch: {
            permission(val) {
                this.roleIds = _map(this.$get(val, 'roles', []), 'id');
            },
        },

        methods: {
            handleAddRoles() {
                if (this.roleIds.length) {
                    this.addRolesToPermission(this.permission.id, this.roleIds);
                }
            },
            handleSelectRoles(val) {
                this.roleDeletedIds = _map(val, ({ id }) => id);
            },
            handleRemoveRoles() {
                if (this.roleDeletedIds.length) {
                    this.removeRolesFromPermission(this.permission.id, this.roleDeletedIds);
                }
            },
        },
    };
</script>

<style lang="scss">
    .add-user-btn {
        padding: 7px 10px !important;
    }
</style>
