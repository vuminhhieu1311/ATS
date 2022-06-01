<template>
    <div class="grid grid-cols-11">
        <div class="col-span-5 bg-white border rounded-md p-6">
            <h4 class="font-semibold capitalize">{{ $t('available stages') }}</h4>
            <draggable
                :set-data="setData"
                :list="list1"
                group="stages"
                class="mt-6 drag-area"
            >
                <div
                    v-for="(element, index) in list1"
                    :key="element.id"
                    class="cursor-move mb-6 flex justify-between list-complete-item"
                >
                    <div class="list-complete-item-handle">
                        {{ index + 1 }}.
                        {{ element.name }}
                    </div>
                    <div
                        class="cursor-pointer text-white px-2 flex items-center move-stage"
                        @click="$emit('addStage', element)"
                    >
                        <span class="material-icons-outlined text-xl">arrow_forward</span>
                    </div>
                </div>
            </draggable>
        </div>
        <div class="col-span-1 flex items-center justify-center">
            <span
                class="cursor-pointer text-3xl material-icons-outlined move-btn"
                @click="$emit('addAllStages')"
            >
                east
            </span>
        </div>
        <div class="col-span-5 bg-white border rounded-md p-6">
            <h4 class="font-semibold capitalize">{{ $t('stages added to pipeline') }}</h4>
            <draggable :list="list2" group="stages" class="mt-6 drag-area">
                <div
                    v-for="(element, index) in list2"
                    :key="element.id"
                    class="cursor-move mb-6 flex justify-between list-complete-item"
                >
                    <div
                        class="cursor-pointer text-white px-2 flex items-center move-stage"
                        @click="$emit('removeStage', element)"
                    >
                        <span class="material-icons-outlined text-xl">arrow_back</span>
                    </div>
                    <div class="list-complete-item-handle">
                        {{ index + 1 }}.
                        {{ element.name }}
                    </div>
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable';

    export default {
        components: {
            draggable,
        },

        props: {
            list1: {
                type: Array,
                default() {
                    return [];
                },
            },
            list2: {
                type: Array,
                default() {
                    return [];
                },
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
        min-height: 600px;
    }
    .list-complete-item {
        transition: all 1s;
    }
    .list-complete-item-handle {
        padding: 5px 12px;
        border: 1px solid #bfcbd9;
        width: 100%;
    }
    .move-stage {
        background-color: theme('colors.primary');
    }
    .list-complete-item.sortable-chosen {
        background: theme('colors.primary');
    }
    .list-complete-item.sortable-ghost {
        background: theme('colors.primary');
    }
    .list-complete-enter,
    .list-complete-leave-active {
        opacity: 0;
    }
    .move-btn:hover {
        opacity: 0.6;
    }
</style>
