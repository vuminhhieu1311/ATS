<template>
    <div v-if="permissionClicked">
        <p class="mb-3">{{ $t('permission') }}: {{ $get(permission, 'name') }}</p>
        <div class="flex items-center">
            <el-select
                v-model="userIds"
                size="small"
                multiple
                class="w-full my-2"
                filterable
                :placeholder="$t('search users')"
                remote
                :remote-method="onSearchUsers"
            >
                <el-option
                    v-for="user in users"
                    :key="$get(user, 'id')"
                    :label="$get(user, 'name')"
                    :value="$get(user, 'id')"
                />
            </el-select>
            <div class="ml-2">
                <el-button
                    type="primary"
                    class="add-user-btn capitalize"
                    size="mini"
                    @click="handleAddUsers"
                >
                    <span class="material-icons text-lg mr-1">add</span>
                    <span class="text-sm">{{ $t('add') }}</span>
                </el-button>
            </div>
        </div>
        <div v-if="permission.users.length">
            <el-table
                ref="multipleTable"
                :data="permission.users"
                style="width: 100%"
                @selection-change="handleSelectUsers"
            >
                <el-table-column
                    type="selection"
                    width="50"
                />
                <el-table-column
                    :label="$t('avatar')"
                    width="70"
                >
                    <template slot-scope="{ row }">
                        <el-avatar
                            size="large"
                            class=" uppercase"
                            :src="$get(row, 'avatarUrl')"
                        >
                            {{ row.name ? row.name.slice(0, 1) : null }}
                        </el-avatar>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('user')"
                >
                    <template slot-scope="{ row }">
                        <p class="font-semibold text-lg">{{ row.name }}</p>
                        <p>{{ row.email }}</p>
                    </template>
                </el-table-column>
            </el-table>
            <div class="mt-5">
                <el-button
                    type="primary"
                    class="capitalize"
                    size="mini"
                    @click="handleRemoveUsers"
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
            addUsersToPermission: {
                type: Function,
                required: true,
            },
            removeUsersFromPermission: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                userIds: [],
                users: [],
                userDeletedIds: [],
            };
        },

        computed: {
            permissionClicked() {
                return !_isEmpty(this.permission);
            },
        },

        methods: {
            async onSearchUsers(userKeyword) {
                try {
                    console.log(userKeyword);
                    // const { data: { data: users } } = await getUsers({ userKeyword });
                    // this.users = users;
                } catch (error) {
                    this.$handleError(error);
                }
            },
            handleAddUsers() {
                if (this.userIds.length) {
                    this.addUsersToPermission(this.permission.id, this.userIds);
                }
            },
            handleSelectUsers(val) {
                this.userDeletedIds = _map(val, ({ id }) => id);
            },
            handleRemoveUsers() {
                if (this.userDeletedIds.length) {
                    this.removeUsersFromPermission(this.permission.id, this.userDeletedIds);
                }
            },
            reset() {
                this.userIds = [];
            },
        },
    };
</script>

<style lang="scss">
    .add-user-btn {
        padding: 7px 10px !important;
    }
</style>
