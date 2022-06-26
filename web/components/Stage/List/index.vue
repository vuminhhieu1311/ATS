<template>
    <div class="mt-6">
        <div class="border">
            <el-table
                :data="stages"
                style="width: 100%"
                fit
                stripe
                header-cell-class-name="table-header"
            >
                <el-table-column :label="$t('stage name')" prop="name" min-width="150">
                    <template slot-scope="{ row }">
                        <span>{{ $get(row, 'name', $t('no data')) }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('active')"
                    align="center"
                    prop="isActive"
                    min-width="120"
                >
                    <template slot-scope="{ row }">
                        <el-switch
                            v-model="row.isActive"
                            :active-value="1"
                            :inactive-value="0"
                            @change="changeActive(row)"
                        />
                    </template>
                </el-table-column>
                <el-table-column :label="$t('action')" align="center" width="120">
                    <template slot-scope="{ row }">
                        <el-button
                            type="primary"
                            icon="el-icon-edit"
                            circle
                            @click="openEditStage($get(row, 'id'))"
                        />
                        <el-button
                            type="danger"
                            icon="el-icon-delete"
                            circle
                            @click="deleteStage($get(row, 'id'))"
                        />
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'StageList',

        props: {
            stages: {
                type: Array,
                required: true,
            },
            deleteStage: {
                type: Function,
                required: true,
            },
        },

        methods: {
            openEditStage(stageId) {
                this.$emit('handleOpenEditStage', stageId);
            },
            async changeActive(stage) {
                this.$emit('handleUpdateStage', stage);
            },
        },
    };
</script>
