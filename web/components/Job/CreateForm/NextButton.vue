<template>
    <el-button type="primary" @click="next">
        {{ $t('next') }}
        <span class="material-icons-outlined ml-2 text-base">arrow_forward_ios</span>
    </el-button>
</template>
<script>
    export default {
        props: {
            next: {
                type: Function,
                required: true,
            },
        },
    };
</script>
