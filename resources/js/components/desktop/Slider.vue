<template>
    <div class="h-100 bg-dark text-white d-flex flex-column justify-content-between"
        :class="{ 'collapsed': isCollapsed }">
        <Logo width="350px" />
        <DistrictInfo v-if="!props.isCollapsed" />
        <ScrollLayout>
            <Navigation />
        </ScrollLayout>
        <SliderFooter v-if="!props.isCollapsed" />
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import Navigation from './navigation/Navigation.vue';
import Logo from './Logo.vue';
import SliderFooter from './SliderFooter.vue';
import DistrictInfo from './DistrictInfo.vue';
import ScrollLayout from '../../layouts/desktop/ScrollLayout.vue';

const props = defineProps({
    isCollapsed: {
        type: Boolean,
        required: true
    },
});
</script>

<style scoped>
.h-100.bg-dark {
    width: var(--slider-width);
    transition: width 0.3s ease;
}

.h-100.bg-dark.collapsed {
    width: 0;
    overflow: hidden;
}

.h-100.bg-dark.collapsed>* {
    display: none;
}
</style>
