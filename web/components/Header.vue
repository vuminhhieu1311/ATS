<template>
    <div class="flex justify-between items-center h-full">
        <div class="cursor-pointer" @click="toggleSidebar">
            <span class="material-icons-outlined">menu</span>
        </div>
        <div>
            <el-dropdown trigger="click" class="mr-3">
                <div class="flex items-center">
                    <img alt="language" :src="require(`~/assets/images/${$i18n.locale}.png`)">
                    <p class="text-white ml-2">{{ $i18n.locale === 'en' ? 'English' : 'Vietnamese' }}</p>
                </div>
                <el-dropdown-menu slot="dropdown">
                    <nuxt-link
                        v-for="locale in locales"
                        :key="locale.value"
                        :to="switchLocalePath(locale.value)"
                    >
                        <el-dropdown-item
                            :class="{ 'el-dropdown-menu__item--active': $i18n.locale === locale.value }"
                        >
                            <div class="flex items-center">
                                <img alt="vi" :src="require(`~/assets/images/${locale.value}.png`)">
                                <p class="ml-2">{{ locale.label }}</p>
                            </div>
                        </el-dropdown-item>
                    </nuxt-link>
                </el-dropdown-menu>
            </el-dropdown>
            <el-dropdown trigger="click">
                <el-avatar size="medium" :src="require('~/assets/images/avatar.jpg')" />
                <el-dropdown-menu slot="dropdown">
                    <el-dropdown-item class="flex items-center" @click.native="logout">
                        <span class="material-icons-outlined text-lg mr-1">logout</span>
                        {{ $t('sign out') }}
                    </el-dropdown-item>
                </el-dropdown-menu>
            </el-dropdown>
        </div>
    </div>
</template>

<script>
    import { mapActions } from 'vuex';
    import { LOCALES } from '~/enums/locales';

    export default {
        name: 'AppHeader',

        data() {
            return {
                locales: LOCALES,
            };
        },

        methods: {
            ...mapActions(['toggleSidebar']),
            async logout() {
                try {
                    await this.$auth.logout();
                } catch (error) {
                    this.$handleError(error);
                }
            },
        },
    };
</script>
