<template>
    <el-pagination
        :current-page="data.currentPage"
        :page-count="data.lastPage"
        class="text-center my-4"
        layout="prev, pager, next"
        background
        hide-on-single-page
        @current-change="go"
    />
</template>

<script>
    import _omit from 'lodash/omit';
    import _assign from 'lodash/assign';

    export default {
        name: 'AppPagination',

        props: {
            data: {
                type: Object,
                required: true,
            },

            pageParam: {
                type: String,
                default: 'page',
            },
        },

        methods: {
            go(page) {
                this.$router.push(this.to(page));
            },

            to(page) {
                const path = this.$route.path;

                const otherParams = _omit(this.$route.query, [this.pageParam]);
                const query = page !== 1
                    ? _assign({}, otherParams, { [this.pageParam]: page })
                    : otherParams;

                return { path, query };
            },
        },
    };
</script>
