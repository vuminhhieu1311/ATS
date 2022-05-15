<template>
    <div id="stream-wrapper h-screen">
        <div v-if="joined" class="grid grid-cols-4">
            <div class="col-span-3 bg-slate-800 h-screen">
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
            <div class="col-span-1">
                Instructions
            </div>
        </div>
        <el-button v-else type="primary" @click="joinAndDisplayLocalStream">Join Stream</el-button>
    </div>
</template>

<script>
    import mixin from './mixin';

    export default {
        name: 'VideoCall',

        mixins: [mixin],

        layout: 'meeting',
    };
</script>

<style lang="scss" scoped>
    @import "./style.scss";
</style>
