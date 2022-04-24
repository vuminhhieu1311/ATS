<template>
    <el-tag :type="statusObject.type" class="capitalize">
        {{ $t(statusObject.text) }}
    </el-tag>
</template>

<script>
    import {
        DRAFT,
        PUBLISHED,
        CLOSED,
        PENDING,
    } from '~/enums/job/job-status';

    export default {
        props: {
            job: {
                type: Object,
                required: true,
            },
        },

        data() {
            return {
                statusMap: {
                    [DRAFT]: {
                        text: DRAFT,
                        type: 'success',
                    },
                    [PUBLISHED]: {
                        text: PUBLISHED,
                        type: 'default',
                    },
                    [CLOSED]: {
                        text: CLOSED,
                        type: 'danger',
                    },
                    [PENDING]: {
                        text: PENDING,
                        type: 'info',
                    },
                },
            };
        },

        computed: {
            statusObject() {
                return this.$get(this.statusMap, this.$get(this.job, 'status'));
            },
        },
    };
</script>
