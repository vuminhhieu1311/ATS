<template>
    <el-tag :type="statusObject.type" class="capitalize">
        {{ $t(statusObject.text) }}
    </el-tag>
</template>

<script>
    import {
        NEW,
    } from '~/enums/candidate/candidate-status';

    export default {
        props: {
            candidate: {
                type: Object,
                required: true,
            },
        },

        data() {
            return {
                statusMap: {
                    [NEW]: {
                        text: NEW,
                        type: 'primary',
                    },
                },
            };
        },

        computed: {
            statusObject() {
                return this.$get(this.statusMap, this.$get(this.candidate, 'status'));
            },
        },
    };
</script>
