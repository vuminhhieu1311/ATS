<template>
    <div class="bg-white border rounded filter-container">
        <div class="p-5 mb-8">
            <h3 class="font-semibold capitalize mb-5">{{ $t("filtering options") }}</h3>
            <el-form>
                <el-form-item>
                    <el-checkbox-group v-model="statuses" @change="((val) => { onChangeValue('statuses', val) })">
                        <div>
                            <el-checkbox label="new">{{ $t('new events') }}</el-checkbox>
                        </div>
                        <div>
                            <el-checkbox label="updated">{{ $t('updated events') }}</el-checkbox>
                        </div>
                        <div>
                            <el-checkbox label="finished">{{ $t('finished events') }}</el-checkbox>
                        </div>
                        <div>
                            <el-checkbox label="canceled">{{ $t('canceled events') }}</el-checkbox>
                        </div>
                    </el-checkbox-group>
                </el-form-item>
                <el-form-item>
                    <el-input
                        v-model="candidate"
                        :placeholder="$t('candidate')"
                        clearable
                        class="w-full"
                        @input="((val) => { onChangeValue('candidate', val) })"
                    />
                </el-form-item>
                <el-form-item>
                    <el-input
                        v-model="jobName"
                        :placeholder="$t('job name')"
                        clearable
                        class="w-full"
                        @input="((val) => { onChangeValue('jobName', val) })"
                    />
                </el-form-item>
                <el-form-item>
                    <el-input
                        v-model="interviewer"
                        :placeholder="$t('interviewer')"
                        clearable
                        class="w-full"
                        @input="((val) => { onChangeValue('interviewer', val) })"
                    />
                </el-form-item>
            </el-form>
        </div>
        <el-image :src="require('~/assets/images/calendar.png')" alt="calendar" class="calendar-image" />
    </div>
</template>

<script>
    import _omit from 'lodash/omit';

    export default {
        name: 'FilterCalendar',

        props: {
            searchInterviews: {
                type: Function,
                required: true,
            },
        },

        data() {
            return {
                query: {},
                statuses: [],
                candidate: null,
                jobName: null,
                interviewer: null,
            };
        },

        methods: {
            onChangeValue(key, value) {
                this.query = value
                    ? { ...this.query, [key]: value }
                    : _omit(this.query, key);

                this.searchInterviews(this.query);
            },
        },
    };
</script>

<style lang="scss" scoped>
    .calendar-image {
        width: 100%;
    }
</style>
