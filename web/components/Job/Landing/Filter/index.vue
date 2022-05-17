<template>
    <div>
        <el-card shadow="hover" class="cursor-pointer">
            <div slot="header" class="text-center">
                <span class="text-white capitalize">{{ $t('location') }}</span>
            </div>
            <el-input
                v-model="location"
                prefix-icon="el-icon-search"
                :placeholder="$t('location')"
                clearable
                @input="onChangeLocation"
            />
            <el-checkbox-group
                v-model="checkedLocations"
                class="mt-5"
                @change="(val) => onChangeValue('locations', val)"
            >
                <div v-for="(location, index) in locations" :key="index">
                    <el-checkbox :label="$get(location, 'city')" />
                </div>
            </el-checkbox-group>
        </el-card>
        <el-card shadow="hover" class="cursor-pointer my-5">
            <div slot="header" class="text-center">
                <span class="text-white capitalize">{{ $t('job tag') }}</span>
            </div>
            <el-input
                v-model="tag"
                prefix-icon="el-icon-search"
                :placeholder="$t('job tag')"
                clearable
                @input="onChangeTag"
            />
            <el-checkbox-group
                v-model="checkedTags"
                class="mt-5"
                @change="(val) => onChangeValue('tags', val)"
            >
                <div v-for="(tag, index) in jobTags" :key="index">
                    <el-checkbox :label="$get(tag, 'name')" />
                </div>
            </el-checkbox-group>
        </el-card>
        <el-card shadow="hover" class="cursor-pointer my-5">
            <div slot="header" class="text-center">
                <span class="text-white capitalize">{{ $t('employment type') }}</span>
            </div>
            <el-checkbox-group
                v-model="checkedTypes"
                @change="(val) => onChangeValue('types', val)"
            >
                <div v-for="(type, index) in jobTypes" :key="index">
                    <el-checkbox :label="type" />
                </div>
            </el-checkbox-group>
        </el-card>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        name: 'LandingFilter',

        mixins: [mixin],
    };
</script>

<style lang="scss">
    .el-card__header {
        background-color: theme('colors.primary');
        padding: 10px 20px;
        font-weight: 800;
    }
    .el-checkbox__label {
        text-transform: capitalize;
    }
</style>
