<template>
    <div class="bg-white shadow-xl rounded p-5">
        <div class="flex flex-wrap w-full">
            <div class="w-full lg:w-2/3 p-0 lg:pr-5 pb-5 lg:pb-0">
                <el-card shadow="never">
                    <div class="flex justify-between mb-5">
                        <el-input
                            v-model="name"
                            class="max-w-sm w-full"
                            :placeholder="$t('permission name')"
                            size="small"
                            prefix-icon="el-icon-search"
                            clearable
                            @change="onSearchPermissions"
                        />
                    </div>
                    <div class="permission-table">
                        <el-table
                            :data="permissions"
                            style="width: 100%"
                            highlight-current-row
                            :empty-text="$t('no data')"
                            header-cell-class-name="table-header"
                            default-expand-all
                            row-key="id"
                            class="cursor-pointer"
                            @row-click="rowClicked"
                        >
                            <el-table-column
                                prop="name"
                                :label="$t('permission name')"
                            >
                                <template slot-scope="{ row }">
                                    <span>{{ $get(row, 'name') }}</span>
                                </template>
                            </el-table-column>
                            <el-table-column
                                prop="description"
                                :label="$t('description')"
                            >
                                <template slot-scope="{ row }">
                                    <span>{{ $get(row, 'name') }}</span>
                                </template>
                            </el-table-column>
                        </el-table>
                    </div>
                </el-card>
            </div>
            <el-card
                class="basic-tabs w-full lg:w-1/3"
                shadow="never"
                :body-style="{ paddingTop: '0px' }"
            >
                <el-tabs v-model="currentTab">
                    <el-tab-pane
                        v-for="(tab, index) in tabs"
                        :key="index"
                        :label="$t(tab)"
                        :name="tab"
                    >
                        <component
                            :is="currentTabComponent"
                            :ref="`ref${tab}`"
                            :permission="permission"
                            :add-users-to-permission="addUsersToPermission"
                            :remove-users-from-permission="removeUsersFromPermission"
                        />
                    </el-tab-pane>
                </el-tabs>
            </el-card>
        </div>
    </div>
</template>

<script>
    import mixin from './mixin';
    import UsersTab from './UsersTab.vue';

    export default {
        name: 'PermissionList',

        components: {
            UsersTab,
        },

        mixins: [mixin],
    };
</script>
