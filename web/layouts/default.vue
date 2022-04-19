<template>
    <el-container>
        <SideBar />
        <el-container :class="`p-8 content ${sidebarCollapsed ? 'content' : 'content--resize' }`">
            <el-header class="bg-primary rounded text-white">
                <Header />
            </el-header>
            <div class="mt-8">
                <Nuxt />
            </div>
        </el-container>
    </el-container>
</template>

<script>
    import { mapState } from 'vuex';

    export default {
        name: 'DefaultLayout',

        middleware: 'auth',

        data() {
            return {};
        },

        computed: {
            ...mapState(['sidebarCollapsed']),
        },
    };
</script>

<style lang="scss">
    .content {
        margin-left: 63px;
        transition: all 0.4s ease;
        &--resize {
            margin-left: 250px;
        }
    }
</style>
