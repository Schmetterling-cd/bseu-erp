<template>
    <div class="d-flex flex-column justify-content-center align-items-center h-100 mx-0 my-0 px-0 py-0 bseu-icon"
        :style="{ width: size, height: size }">
        <slot></slot>
    </div>
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

.bseu-icon:hover :deep(i) {
    color: var(--main-bseu-color) !important;
}
</style>
