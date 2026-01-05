<template>
    <a
        class="nav-link-simple d-flex align-items-center px-3 py-3 text-white text-decoration-none"
        :class="{ 'active': link.active }"
        @click.prevent="$emit('click')"
    >
        <i v-if="link.icon" :class="['bi', link.icon, 'me-3']"></i>
        <i v-else class="bi bi-list me-3"></i>
        <span>{{ link.title }}</span>
    </a>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

defineProps({
    link: {
        type: Object,
        required: true
    },
});

defineEmits(['click']);
</script>

<style scoped>
.nav-link-simple {
    cursor: pointer;
    transition: all 0.2s ease;
}

.nav-link-simple:hover:not(.active) {
    background-color: rgba(255, 255, 255, 0.1) !important;
}

.nav-link-simple.active {
    background-color: var(--main-bseu-color) !important;
    font-weight: 600;
}
</style>
