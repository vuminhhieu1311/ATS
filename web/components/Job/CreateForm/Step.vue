<template>
    <el-steps
        :active="stepActive"
        process-status="success"
        finish-status="success"
        direction="vertical"
    >
        <el-step
            v-for="(step, index) in stepData"
            :key="index"
            :class="{ 'active' : index <= stepActive, 'actived' : index < stepActive }"
        >
            <div slot="title" class="uppercase text-sm font-semibold mt-1">
                {{ step.title }}
            </div>
        </el-step>
    </el-steps>
</template>

<script>
    export default {
        name: 'JobStep',

        props: {
            stepActive: {
                type: Number,
                required: true,
            },
        },

        data() {
            return {
                stepData: [
                    {
                        title: 'details',
                    },
                    {
                        title: 'description',
                    },
                    {
                        title: 'pipeline',
                    },
                ],
            };
        },
    };
</script>
