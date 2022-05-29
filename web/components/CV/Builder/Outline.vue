<template>
    <div class="bg-white border rounded-md p-6">
        <draggable
            :set-data="setData"
            :list="outline"
            group="outline"
            class="mt-6 drag-area"
        >
            <div
                v-for="(element, index) in outline"
                :key="index"
                class="cursor-move mb-6 flex justify-between list-complete-item"
            >
                <div class="list-complete-item-handle">
                    {{ index + 1 }}.
                    {{ element }}
                </div>
                <div
                    class="text-white cursor-pointer px-2 flex items-center delete-outline"
                    @click="deleteOutline(element)"
                >
                    <span class="material-icons-outlined text-xl">delete_outline</span>
                </div>
            </div>
        </draggable>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        name: 'DraggableOutline',

        components: {
            draggable,
        },

        props: {
            outline: {
                type: Array,
                default() {
                    return [];
                },
            },
            deleteOutline: {
                type: Function,
                required: true,
            },
        },

        methods: {
            setData(dataTransfer) {
                // to avoid Firefox bug
                // Detail see : https://github.com/RubaXa/Sortable/issues/1012
                dataTransfer.setData('Text', '');
            },
        },
    };
</script>

<style lang="scss">
    .drag-area {
        min-height: 300px;
    }
    .list-complete-item {
        transition: all 1s;
    }
    .list-complete-item-handle {
        padding: 5px 12px;
        border: 1px solid #bfcbd9;
        width: 100%;
    }
    .delete-outline {
        background-color: theme('colors.primary');
    }
    .list-complete-item.sortable-chosen {
        background: theme('colors.primary');
        color: theme('colors.white');
    }
    .list-complete-item.sortable-ghost {
        background: theme('colors.primary');
    }
    .list-complete-enter,
    .list-complete-leave-active {
        opacity: 0;
    }
</style>
