<template>
    <div>
        <span
            class="material-icons-outlined text-xl"
            :class="`${$get(candidate, 'isStar') ? 'text-yellow-400' : 'text-gray-500' }`"
            @click="starCandidate($get(candidate, 'id'))"
        >
            {{ $get(candidate, 'isStar') ? 'star' : 'star_outline' }}
        </span>
    </div>
</template>

<script>
    export default {
        props: {
            candidate: {
                type: Object,
                required: true,
            },
            starCandidate: {
                type: Function,
                required: true,
            },
        },
    };
</script>
