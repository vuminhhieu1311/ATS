<template>
    <div class="w-full">
        <VideoCall
            v-if="interview"
            :token="token"
            :channel-name="`interview-${interview.id}`"
            :interview="interview"
            :update-interview="updateInterview"
        />
        <div v-else class="h-screen flex items-center justify-center">
            <el-result
                icon="error"
                :title="$t('permission denied')"
                :sub-title="$t('join meeting denied')"
            >
                <template slot="extra">
                    <nuxt-link to="/">
                        <el-button type="primary" size="medium">{{ $t('homepage') }}</el-button>
                    </nuxt-link>
                </template>
            </el-result>
        </div>
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

        async asyncData({ $axios, params }) {
            try {
                const [
                    { data: interview },
                    { token },
                ] = await Promise.all([
                    $axios.$get(`/interviews/${params.id}`),
                    $axios.$post(`video-call/interviews/${params.id}/token`, {
                        channelName: `interview-${params.id}`,
                    }),
                ]);

                return {
                    interview,
                    token,
                };
            } catch (error) {
                return {
                    interview: null,
                    token: null,
                };
            }
        },

        methods: {
            updateInterview(interview) {
                this.interview = interview;
            },
        },
    };
</script>
