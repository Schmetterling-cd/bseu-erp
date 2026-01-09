<template>
    <button class="d-flex flex-column justify-content-center border align-items-center bg-transparent border-0 h-100 mx-0 my-0 px-0 py-0 bseu-icon"
        :style="{ width: size, height: size }">
        <slot></slot>
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    size: {
        type: String,
        required: true
    },
});
</script>

<style scoped>
.bseu-icon {
    cursor: pointer;
}

.bseu-icon :deep(i) {
    transition: color 0.2s ease;
}

.bseu-icon:not(:disabled):hover :deep(i) {
    color: var(--main-bseu-color) !important;
}
</style>
