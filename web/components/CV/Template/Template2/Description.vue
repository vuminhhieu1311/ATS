<template>
    <div class="resume_item resume_about">
        <div class="title">
            <p class="bold">About me</p>
        </div>
        <p>{{ $get($auth.user, 'candidate.description') }}</p>
    </div>
</template>

<script>
    export default {
        name: 'DescriptionPart',
    };
</script>
