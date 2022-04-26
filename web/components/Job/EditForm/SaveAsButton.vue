<template>
    <el-dropdown class="ml-3" @command="handleCommand">
        <el-button type="primary" class="capitalize el-dropdown-link">
            {{ $t('save as') }} <i class="el-icon-arrow-down el-icon--right" />
        </el-button>
        <el-dropdown-menu slot="dropdown">
            <el-dropdown-item
                v-for="(value, index) in jobStatuses"
                :key="index"
                :command="value"
                class="capitalize"
            >
                {{ $t(value) }}
            </el-dropdown-item>
        </el-dropdown-menu>
    </el-dropdown>
</template>
<script>
    import { ALL_STATUS } from '~/enums/job/job-status';

    export default {
        props: {
            handleCommand: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                jobStatuses: ALL_STATUS,
            };
        },
    };
</script>
