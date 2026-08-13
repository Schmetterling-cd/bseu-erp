<template>
   <button
        class="btn btn-toggle align-items-center rounded w-100 text-start text-white p-3 border-0 d-flex justify-content-between"
        :class="{
            'collapsed': group.active,
            'bg-dark': group.active,
            'bg-dark-subtle': group.active,
            'has-active': hasActiveItem
        }" @click="handleToggle">
        <div class="d-flex align-items-center">
            <i v-if="group.icon" :class="['bi', group.icon, 'me-3']"></i>
            <span class="fw-medium">{{ group.title }}</span>
        </div>
        <i :class="['bi', group.active ? 'bi-chevron-up' : 'bi-chevron-down', 'text-white-50']"></i>
    </button>
</template>

<script setup>
import { defineProps, defineModel } from 'vue';

const group = defineModel('group');

const props = defineProps({
    hasActiveItem: {
        type: Boolean,
        required: true
    },
});

const handleToggle = () => {
    group.value.active = props.hasActiveItem ? true : !group.value.active;
}
</script>

<style scoped>
.btn-toggle {
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-toggle:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
}

.btn-toggle:focus {
    box-shadow: none;
    outline: none;
}

.has-active {
    border-left: 3px solid var(--main-system-color);
}
</style>