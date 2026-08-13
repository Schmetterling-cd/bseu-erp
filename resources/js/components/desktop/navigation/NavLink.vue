<template>
    <a
        class="nav-link-simple d-flex align-items-center px-3 py-3 text-white text-decoration-none"
        :class="{ 'active': isActive }"
        @click.prevent="setActive"
    >
        <i v-if="link.icon" :class="['bi', link.icon, 'me-3']"></i>
        <i v-else class="bi bi-list me-3"></i>
        <span>{{ link.title }}</span>
    </a>
</template>

<script setup>
import { defineProps, computed } from 'vue';
import { useStore } from 'vuex';
import { useRouter } from 'vue-router';

const props = defineProps({
    element: {
        type: Object,
        required: true
    }
});

const link = computed(() => props.element);
const store = useStore();
const isActive = computed(() => store.state.navigation.activeItemId === link.value.uuid);
const router = useRouter();

const setActive = () => {
    store.commit('navigation/setActiveItem', link.value.uuid);
    router.push(link.value.link);
}
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
    background-color: var(--main-system-color) !important;
    font-weight: 600;
}
</style>
