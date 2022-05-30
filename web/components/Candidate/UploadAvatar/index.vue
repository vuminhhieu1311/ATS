<template>
    <div class="pr-10 mt-8">
        <div class="flex justify-center">
            <el-avatar :size="250" :src="`http://localhost:8000${$auth.user.profile_photo_url}`" />
        </div>
        <div class="flex justify-center mt-8">
            <el-button
                type="primary"
                @click="toggleShow"
            >
                <span class="material-icons-outlined mr-1">file_upload</span>
                {{ $t('upload avatar') }}
            </el-button>
        </div>
        <Upload
            v-model="show"
            :key="imageCropperKey"
            field="img"
            :width="300"
            :height="300"
            :url="`http://localhost:8000/api/users/${$auth.user.id}/upload-avatar`"
            :params="params"
            :headers="headers"
            img-format="png"
            lang-type="en"
            @crop-success="cropSuccess"
            @crop-upload-success="cropUploadSuccess"
            @crop-upload-fail="cropUploadFail"
        />
    </div>
</template>

<script>
    import Upload from 'vue-image-crop-upload/upload-2.vue';

    export default {
        name: 'UploadAvatar',

        components: {
            Upload,
        },

        data() {
            return {
                show: false,
                imageCropperKey: 0,
                params: {
                    key: 'value',
                },
                headers: {},
                imgDataUrl: '',
            };
        },

        methods: {
            toggleShow() {
                this.show = !this.show;
            },
            cropSuccess(imgDataUrl) {
                this.imgDataUrl = imgDataUrl;
            },
            cropUploadSuccess(jsonData) {
                this.show = false;
                this.imageCropperKey += 1;
                this.$auth.setUser(jsonData);
                this.$message.success(this.$t('update successfully'));
            },
            cropUploadFail() {
                this.$handleError(this.$t('something went wrong'));
            },
        },
    };
</script>

<style lang="scss" scoped>
</style>
