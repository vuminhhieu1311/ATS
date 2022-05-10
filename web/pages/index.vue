/* eslint-disable */
<template>
    <div>
        <!-- <el-button v-if="!video" type="primary" @click="video = true">Start Video Call</el-button> -->
        <agora-react-web-uikit
            style="width: 100%; height: 100vh; display: flex;"
            appId="1aed775f74034be7a1c59605cdef13b7"
            channel="test"
            :token="token"
            :enableVideo="false"
        />
    </div>
</template>

<script>
    require('~/static/agora-uikit');

    export default {
        name: 'DashboardPage',

        data() {
            return {
                video: false,
                token: '0061aed775f74034be7a1c59605cdef13b7IAAe65bJg4ZbkAj9v3qH3nWg1mYtLoQDzGUzpNNOptQFzQx+f9gAAAAAEACr2kwLcZJ6YgEAAQBxknpi',
            };
        },

        mounted() {
            const el = this.$el.querySelector('agora-react-web-uikit');
            console.log(el);

            // Add event listener and subscribe to custom event
            el.addEventListener('agoraUIKitEndcall', () => {
                console.log('hello from html');
                // handle endcall event
                el.remove();
            });
        },
    };
</script>
