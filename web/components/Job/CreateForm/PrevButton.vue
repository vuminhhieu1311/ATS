<template>
    <el-button type="info" @click="prev">
        <span class="material-icons-outlined mr-2 text-base">arrow_back_ios</span>
        {{ $t('previous') }}
    </el-button>
</template>
<script>
    export default {
        props: {
            prev: {
                type: Function,
                required: true,
            },
        },
    };
</script>
