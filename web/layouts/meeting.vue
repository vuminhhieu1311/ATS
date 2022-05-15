<template>
    <el-container>
        <Nuxt />
    </el-container>
</template>

<script>
    export default {
        name: 'MeetingLayout',

        middleware: 'auth',
    };
</script>
