<template>
    <el-tag :type="typeObject.type" class="capitalize">
        {{ $t(typeObject.text) }}
    </el-tag>
</template>

<script>
    import {
        FULL_TIME,
        PART_TIME,
        CONTRACT,
        TEMPORARY,
        INTERNSHIP,
    } from '~/enums/job/employment-type';

    export default {
        props: {
            job: {
                type: Object,
                required: true,
            },
        },

        data() {
            return {
                typeMap: {
                    [FULL_TIME]: {
                        text: FULL_TIME,
                        type: 'default',
                    },
                    [PART_TIME]: {
                        text: PART_TIME,
                        type: 'success',
                    },
                    [CONTRACT]: {
                        text: CONTRACT,
                        type: 'info',
                    },
                    [TEMPORARY]: {
                        text: TEMPORARY,
                        type: 'danger',
                    },
                    [INTERNSHIP]: {
                        text: INTERNSHIP,
                        type: 'warning',
                    },
                },
            };
        },

        computed: {
            typeObject() {
                return this.$get(this.typeMap, this.$get(this.job, 'employmentType'));
            },
        },
    };
</script>
