<template>
    <div class="flex justify-between items-center h-full">
        <div class="cursor-pointer" @click="toggleSidebar">
            <span class="material-icons-outlined">menu</span>
        </div>
        <div>
            <el-dropdown>
                <el-avatar size="medium" :src="require('~/assets/images/avatar.jpg')" />
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item>View</el-dropdown-item>
                    <el-dropdown-item>Add</el-dropdown-item>
                    <el-dropdown-item>Delete</el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';

    export default {
        name: 'AppHeader',

        methods: {
            ...mapActions(['toggleSidebar']),
        },
    };
</script>
