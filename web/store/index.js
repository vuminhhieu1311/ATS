import Storage from 'store';

const SIDEBAR_COLLAPSED_STORAGE_KEY = 'sidebarCollapsed';

export const state = () => ({
    sidebarCollapsed: false,
});

export const actions = {
    async nuxtClientInit({ commit }) {
        commit('setSidebarCollapsed', Storage.get(SIDEBAR_COLLAPSED_STORAGE_KEY, false));
    },
    toggleSidebar({ state, commit }) {
        commit('setSidebarCollapsed', !state.sidebarCollapsed);
    },
};

export const mutations = {
    setSidebarCollapsed(state, value) {
        Storage.set(SIDEBAR_COLLAPSED_STORAGE_KEY, value);
        state.sidebarCollapsed = value;
    },
};
