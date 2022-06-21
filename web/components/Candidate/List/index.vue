<template>
    <div>
        <div class="border">
            <el-table
                :data="candidates"
                fit
                stripe
                header-cell-class-name="table-header"
            >
                <el-table-column :label="$t('name')" prop="name" min-width="150">
                    <template slot-scope="{ row }">
                        <nuxt-link :to="`/candidates/${$get(row, 'id')}`" class="flex justify-start items-center">
                            <div>
                                <Avatar
                                    :username="$get(row, 'user.name')"
                                    :src="`http://localhost:8000${$get(row, 'user.profile_photo_url')}`"
                                    :size="40"
                                    class="mr-3"
                                />
                            </div>
                            <span class="font-semibold">{{ $get(row, 'user.name') }}</span>
                        </nuxt-link>
                    </template>
                </el-table-column>
                <el-table-column :label="$t('email')" prop="email" min-width="100">
                    <template slot-scope="{ row }">
                        <span>{{ $get(row, 'user.email') }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('phone number')"
                    align="center"
                    prop="phoneNumber"
                    min-width="150"
                >
                    <template slot-scope="{ row }">
                        <span>{{ $get(row, 'user.phoneNumber') }}</span>
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('status')"
                    align="center"
                    prop="status"
                    min-width="80"
                >
                    <template slot-scope="{ row }">
                        <CandidateStatus :candidate="row" />
                    </template>
                </el-table-column>
                <el-table-column
                    :label="$t('resume')"
                    prop="resume"
                    min-width="90"
                    align="center"
                >
                    <template slot-scope="{ row }">
                        <span
                            class="material-icons-outlined cursor-pointer"
                            @click="openResume($get(row, 'resume.resumeId', 0))"
                        >
                            picture_as_pdf
                        </span>
                    </template>
                </el-table-column>
                <el-table-column :label="$t('action')" align="center" width="100">
                    <div slot-scope="{ row }" class="flex items-center">
                        <el-button
                            type="primary"
                            icon="el-icon-edit"
                            circle
                            class="mr-1"
                        />
                        <el-button circle @click="starCandidate($get(row, 'id'))">
                            <span
                                class="material-icons-outlined text-base"
                                :class="`${$get(row, 'isStar') ? 'text-yellow-400' : 'text-gray-500' }`"
                            >
                                {{ $get(row, 'isStar') ? 'star' : 'star_outline' }}
                            </span>
                        </el-button>
                    </div>
                </el-table-column>
            </el-table>
        </div>
        <Pagination :data="meta" />
    </div>
</template>

<script>
    import Pagination from '~/components/Shared/Pagination.vue';
    import CandidateStatus from '~/components/Shared/CandidateStatus.vue';
    import Avatar from 'vue-avatar';

    export default {
        name: 'CandidateList',

        components: {
            Pagination,
            CandidateStatus,
            Avatar,
        },

        props: {
            candidates: {
                type: Array,
                required: true,
            },
            meta: {
                type: Object,
                required: true,
            },
            starCandidate: {
                type: Function,
                required: true,
            },
        },

        methods: {
            async openResume(resumeId) {
                this.$refs.resumeViewer.open(resumeId);
            },
        },
    };
</script>
