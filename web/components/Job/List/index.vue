<template>
    <div>
        <div class="border">
            <el-table
                :data="jobs"
                fit
                stripe
                header-cell-class-name="table-header"
            >
                <el-table-column :label="$t('name')" prop="name" min-width="120">
                    <template slot-scope="{ row }">
                        <nuxt-link :to="`/jobs/${$get(row, 'id')}`" class="flex justify-start items-center">
                            <div>
                                <el-avatar :src="require('~/assets/images/logo-icon.png')" class="mr-3" />
                            </div>
                            <span class="font-semibold">{{ $get(row, 'name') }}</span>
                        </nuxt-link>
                    </template>
                </el-table-column>
                <el-table-column :label="$t('location')" prop="location" min-width="100">
                    <template slot-scope="{ row }">
                        <span>
                            {{ $get(row, 'city') }} - {{ $get(row, 'country') }}
                        </span>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('type')"
                    align="center"
                    prop="employmentType"
                    min-width="90"
                >
                    <template slot-scope="{ row }">
                        <JobType :job="row" />
                    </template>
                </el-table-column>
                <el-table-column :label="$t('offer')" prop="offer" min-width="160">
                    <template slot-scope="{ row }">
                        <span>{{ offer(row) }}</span>
                    </template>
                </el-table-column>
                <el-table-column :label="$t('deadline')" prop="deadline" min-width="100">
                    <template slot-scope="{ row }">
                        <span>{{ formatDate($get(row, 'deadline')) }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('status')"
                    align="center"
                    prop="status"
                    min-width="90"
                >
                    <template slot-scope="{ row }">
                        <JobStatus :job="row" />
                    </template>
                </el-table-column>
                <el-table-column :label="$t('action')" align="center" width="120">
                    <template slot-scope="{ row }">
                        <nuxt-link :to="`/jobs/${$get(row, 'id')}/edit`">
                            <el-button
                                type="primary"
                                icon="el-icon-edit"
                                circle
                            />
                        </nuxt-link>
                        <el-button
                            type="danger"
                            icon="el-icon-delete"
                            circle
                            @click="deleteJob($get(row, 'id'))"
                        />
                    </template>
                </el-table-column>
            </el-table>
        </div>
        <Pagination :data="meta" />
    </div>
</template>

<script>
    import Pagination from '~/components/Shared/Pagination.vue';
    import JobType from '~/components/Shared/JobType.vue';
    import JobStatus from '~/components/Shared/JobStatus.vue';
    import mixin from './mixin';

    export default {
        name: 'JobList',

        components: {
            Pagination,
            JobType,
            JobStatus,
        },

        mixins: [mixin],
    };
</script>
