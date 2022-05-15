import AgoraRTC from 'agora-rtc-sdk-ng';

export default {
    props: {
        token: {
            type: String,
            required: true,
        },
        channelName: {
            type: String,
            required: true,
        },
    },

    data() {
        return {
            localAudioTrack: null,
            localVideoTrack: null,
            client: AgoraRTC.createClient({
                mode: 'rtc',
                codec: 'vp8',
            }),
            remoteUsers: {},
            joined: false,
            microMuted: false,
            cameraMuted: false,
        };
    },

    methods: {
        async joinAndDisplayLocalStream() {
            this.joined = true;
            this.client.on('user-published', this.handleUserJoined);
            this.client.on('user-left', this.handleUserLeft);
            // Join an RTC channel.
            const uid = await this.client.join(process.env.AGORA_APP_ID, this.channelName, this.token, null);
            // Create a local audio track from the audio sampled by a microphone
            // and a local video track from the video captured by a camera.
            [this.localAudioTrack, this.localVideoTrack] = await AgoraRTC.createMicrophoneAndCameraTracks();

            // Publish the local audio and video tracks to the RTC channel.
            await this.client.publish([this.localAudioTrack, this.localVideoTrack]);

            const videoPlayer = `<div class="video-container m-3" id="user-container-${uid}">
                                    <div class="video-player h-full" id="user-${uid}"></div>
                                </div>`;
            this.$refs.videoStream.insertAdjacentHTML('beforeend', videoPlayer);
            // Play the local video track.
            this.localVideoTrack.play(`user-${uid}`);
        },
        async leaveAndRemoveLocalStream() {
            this.joined = false;
            this.localAudioTrack.close();
            this.localVideoTrack.close();
            // Leave the channel.
            await this.client.leave();
        },
        async handleUserJoined(user, mediaType) {
            this.remoteUsers[user.uid] = user;
            // Subscribe to the remote user when the SDK triggers the "user-published" event
            await this.client.subscribe(user, mediaType);

            // If the remote user publishes a video track.
            if (mediaType === 'video') {
                let videoPlayer = document.getElementById(`user-container-${user.uid}`);
                if (videoPlayer != null) {
                    videoPlayer.remove();
                }

                videoPlayer = `<div class="video-container m-3" id="user-container-${user.uid}">
                                    <div class="video-player h-full" id="user-${user.uid}"></div>
                                </div>`;
                this.$refs.videoStream.insertAdjacentHTML('beforeend', videoPlayer);

                // Play the remote video track.
                user.videoTrack.play(`user-${user.uid}`);
            }

            // If the remote user publishes an audio track.
            if (mediaType === 'audio') {
                user.audioTrack.play();
            }
        },
        handleUserLeft(user) {
            delete this.remoteUsers[user.uid];
            const videoPlayer = document.getElementById(`user-container-${user.uid}`);

            if (videoPlayer) {
                videoPlayer.remove();
            }
        },
        async toggleMicrophone() {
            await this.localAudioTrack.setMuted(!this.microMuted);
            this.microMuted = !this.microMuted;
        },
        async toggleCamera() {
            await this.localVideoTrack.setMuted(!this.cameraMuted);
            this.cameraMuted = !this.cameraMuted;
        },
    },
};
