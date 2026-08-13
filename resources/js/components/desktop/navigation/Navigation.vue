<template>
    <li class="nav-item" v-for="element in navigation" :key="element.uuid">
        <component :is="generateNvigationElement(element)" :element="element"/>
    </li>
</template>

<script setup>
import { computed, provide } from 'vue';
import { useStore } from 'vuex';
import NavGroup from './NavGroup.vue';
import NavLink from './NavLink.vue';

const store = useStore();
const navigation = computed(() => store.state.navigation.navigation);

const generateNvigationElement = (element) => {
    if (isGroupElement(element)) {
        return NavGroup;
    }

    return NavLink;
}

provide('generateNvigationElement', generateNvigationElement);

const isGroupElement = (element) => {
    return element.items && Array.isArray(element.items) && element.items.length > 0;
};
</script>

<style scoped>
.nav-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.nav-item:last-child {
    border-bottom: none;
}
</style>
