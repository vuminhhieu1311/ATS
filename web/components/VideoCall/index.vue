<template>
    <div id="stream-wrapper">
        <div v-if="joined">
            <div class="bg-slate-800 h-screen fixed w-2/3">
                <div ref="videoStream" class="video-stream" />
                <div v-if="joined" class="control-btn flex justify-center items-center">
                    <div class="mr-5">
                        <el-button type="primary" circle @click="toggleMicrophone">
                            <span class="material-icons-outlined">{{ microMuted ? 'mic_off' : 'mic' }}</span>
                        </el-button>
                    </div>
                    <div class="mr-5">
                        <el-button type="primary" circle @click="toggleCamera">
                            <span class="material-icons-outlined">{{ cameraMuted ? 'videocam_off' : 'videocam' }}</span>
                        </el-button>
                    </div>
                    <div>
                        <el-button type="danger" circle @click="leaveAndRemoveLocalStream">
                            <span class="material-icons-outlined">call_end</span>
                        </el-button>
                    </div>
                </div>
            </div>
            <div class="bg-white w-1/3 float-right">
                <el-tabs
                    type="card"
                    class="w-full mb-6 border-0"
                >
                    <el-tab-pane>
                        <div slot="label" class="text-base flex items-center pt-2 capitalize">
                            <span class="material-icons mr-2">person</span>
                            <span>{{ $t("candidate info") }}</span>
                        </div>
                        <h1>Candidate Info</h1>
                    </el-tab-pane>
                    <el-tab-pane>
                        <div slot="label" class="text-base flex items-center pt-2 capitalize">
                            <span class="material-icons mr-2">assessment</span>
                            <span>{{ $t("assessment") }}</span>
                        </div>
                        <Assessment :interview="interview" />
                    </el-tab-pane>
                </el-tabs>
            </div>
        </div>
        <el-button v-else type="primary" @click="joinAndDisplayLocalStream">Join Stream</el-button>
    </div>
</template>

<script>
    import Assessment from '~/components/Assessment/index.vue';
    import mixin from './mixin';

    export default {
        name: 'VideoCall',

        components: {
            Assessment,
        },

        mixins: [mixin],

        layout: 'meeting',
    };
</script>

<style lang="scss" scoped>
    @import "./style.scss";
</style>
