<template>
    <div class="w-full">
        <VideoCall />
    </div>
</template>

<script>
    import VideoCall from '~/components/VideoCall/index.vue';

    export default {
        name: 'MeetingPage',

        components: {
            VideoCall,
        },

        layout: 'meeting',
    };
</script>
