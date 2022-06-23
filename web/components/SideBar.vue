<template>
    <div :class="`fixed left-0 top-0 overflow-x-hidden ${sidebarCollapsed ? 'sidebar' : 'sidebar--resize' }`">
        <el-menu
            class="h-screen"
            :default-active="activeMenu"
            :collapse="sidebarCollapsed"
            text-color="#625f6e"
            :unique-opened="false"
            active-text-color="#ffffff"
            :collapse-transition="true"
            mode="vertical"
        >
            <nuxt-link to="/" class="flex justify-center mt-4 mb-3">
                <img
                    v-if="sidebarCollapsed"
                    src="@/assets/images/logo-icon.png"
                    alt="Logo"
                    title="ATS"
                    class="logo-icon"
                >
                <img
                    v-else
                    src="@/assets/images/logo.png"
                    alt="Logo"
                    title="ATS"
                    class="logo"
                >
            </nuxt-link>
            <nuxt-link v-for="item in adminMenu" :key="item.url" :to="item.url">
                <el-menu-item :index="item.url">
                    <span class="material-icons-outlined mr-2">{{ item.icon }}</span>
                    <span slot="title" class="text-base">{{ $t(item.label) }}</span>
                </el-menu-item>
            </nuxt-link>
        </el-menu>
    </div>
</template>

<script>
    import { mapState, mapActions } from 'vuex';

    export default {
        name: 'SideBar',

        data() {
            return {
                adminMenu: [
                    {
                        url: '/',
                        icon: 'home',
                        label: 'dashboard',
                    },
                    {
                        url: '/calendar',
                        icon: 'calendar_month',
                        label: 'calendar',
                    },
                    {
                        url: '/candidates',
                        icon: 'groups',
                        label: 'candidates',
                    },
                    {
                        url: '/pipelines',
                        icon: 'view_week',
                        label: 'pipelines',
                    },
                    {
                        url: '/jobs',
                        icon: 'business_center',
                        label: 'jobs',
                    },
                    {
                        url: '/assessment-forms',
                        icon: 'assessment',
                        label: 'assessment forms',
                    },
                    {
                        url: '/permissions',
                        icon: 'lock',
                        label: 'permissions',
                    },
                ],
            };
        },

        computed: {
            ...mapState(['sidebarCollapsed']),
            activeMenu() {
                const route = this.$route;
                const { meta, path } = route;

                if (meta.activeMenu) {
                    return meta.activeMenu;
                }

                return path;
            },
        },

        methods: {
            ...mapActions(['toggleSidebar']),
        },
    };
</script>

<style lang="scss" scoped>
    .sidebar {
        width: 63px;
        &--resize {
            width: 250px;
        }
    }

    .logo {
        height: 95px;
    }

    .logo-icon {
        height: 45px;
    }
</style>
