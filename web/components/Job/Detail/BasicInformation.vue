<template>
    <div class="w-full md:w-8/12 px-5 -mt-10 mb-10">
        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
            <div class="px-10 pt-10 flex-auto text-center">
                <p class="text-4xl text-text font-semibold capitalize">
                    {{ $t('job information') }}
                </p>
            </div>
            <div class="px-10 pt-5 flex-auto">
                <div class="flex items-center">
                    <div
                        class="icon text-white text-center inline-flex items-center
                        justify-center w-12 h-12 mb-5 shadow-lg rounded-full"
                    >
                        <span class="material-icons-outlined">grade</span>
                    </div>
                    <h1 class="text-2xl font-semibold ml-5 mb-5 capitalize">
                        {{ $t('description' ) }}
                    </h1>
                </div>
                <p class="ml-10 pl-7" v-html="$get(job, 'description')" />
            </div>
            <div class="px-10 pt-5 flex-auto">
                <div class="flex items-center">
                    <div
                        class="icon text-white text-center inline-flex items-center
                        justify-center w-12 h-12 mb-5 shadow-lg rounded-full"
                    >
                        <span class="material-icons-outlined">grade</span>
                    </div>
                    <h6 class="text-2xl font-semibold ml-5 mb-5 capitalize">
                        {{ $t('requirement' ) }}
                    </h6>
                </div>
                <p class="ml-10 pl-7" v-html="$get(job, 'requirement')" />
            </div>
            <div class="px-10 pt-5 pb-10 flex-auto">
                <div class="flex items-center">
                    <div
                        class="icon text-white text-center inline-flex items-center
                        justify-center w-12 h-12 mb-5 shadow-lg rounded-full"
                    >
                        <span class="material-icons-outlined">grade</span>
                    </div>
                    <h6 class="text-2xl font-semibold ml-5 mb-5 capitalize">
                        {{ $t('benefit' ) }}
                    </h6>
                </div>
                <p class="ml-10 pl-7" v-html="$get(job, 'benefit')" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            job: {
                type: Object,
                required: true,
            },
        },
    };
</script>

<style lang="scss" scoped>
    .icon {
        background-color: theme('colors.primary');
    }
</style>
