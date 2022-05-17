<template>
    <el-container>
        <el-header class="bg-white">
            <CandidateHeader />
        </el-header>
        <div>
            <Nuxt />
        </div>
    </el-container>
</template>

<script>
    export default {
        name: 'CandidateLayout',

        middleware: ['auth'],

        auth: 'guest',
    };
</script>
