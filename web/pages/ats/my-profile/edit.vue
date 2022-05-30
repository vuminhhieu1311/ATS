<template>
    <div class="w-full">
        <div class="flex flex-wrap">
            <div class="w-full lg:w-9/12">
                <EditProfile :user="user" />
            </div>
            <div class="w-full lg:w-3/12">
                <!-- <CardSummary :candidate="candidate" /> -->
            </div>
        </div>
    </div>
</template>

<script>
    import EditProfile from '~/components/Candidate/EditProfile/index.vue';
    // import CardSummary from '~/components/Candidate/Detail/CardSummary/index.vue';

    export default {
        name: 'EditProfilePage',

        components: {
            EditProfile,
            // CardSummary,
        },

        layout: 'candidate',

        mounted() {
            console.log(this.$auth.user);
        },
    };
</script>
