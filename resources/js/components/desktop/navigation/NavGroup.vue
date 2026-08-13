<template>
    <div class="nav-group">
        <NavGroupButton v-model:group="group" :has-active-item="hasActiveItem" />

        <div class="group-content" :class="{ 'expanded': group.active }">
            <ul class="btn-toggle-nav list-unstyled fw-normal ps-4 small mb-0 bg-dark">
                <li class="nav-item" v-for="element in group.items" :key="element.uuid">
                    <component :is="generateNvigationElement(element)" :element="element"/>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import NavGroupButton from './NavGroupButton.vue';
import { defineProps, computed, inject } from 'vue';
import { useStore } from 'vuex';

const props = defineProps({
    element: {
        type: Object,
        required: true
    }
});

const group = computed(() => props.element);
const generateNvigationElement = inject('generateNvigationElement');
const store = useStore();

const isGroupElement = (element) => {
    return element.items && Array.isArray(element.items) && element.items.length > 0;
};

const elementHasActiveItem = (element) => {
    if (isGroupElement(element)) {
        for (const item of element.items) {
            if (elementHasActiveItem(item)) {
                return true;
            }
        }
    }

    return element.uuid === store.state.navigation.activeItemId;
}

const hasActiveItem = computed(() => {
    return elementHasActiveItem(group.value);
});
</script>

<style scoped>
.nav-group {
    background-color: transparent;
}

.bg-dark-subtle {
    background-color: rgba(255, 255, 255, 0.05) !important;
}

.btn-toggle-nav .nav-link {
    color: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease;
    text-decoration: none;
    cursor: pointer;
}

.btn-toggle-nav .nav-link:hover:not(.active) {
    background-color: rgba(255, 255, 255, 0.05);
    color: white;
}

.btn-toggle-nav .nav-link.active {
    color: white;
    font-weight: 500;
}

/* Контейнер контента с анимацией */
.group-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.group-content.expanded {
    max-height: max-content;
}
</style>
