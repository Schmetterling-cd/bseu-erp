<template>
    <div class="d-flex vh-100 overflow-hidden">
        <Slider :isCollapsed="isCollapsed" @toggle="toggleSidebar" />

        <div class="d-flex flex-column flex-grow-1 bg-light overflow-hidden" :class="{ 'expanded': isCollapsed }">
             <TopBar :isCollapsed="isCollapsed" @toggle="toggleSidebar"/>

            <div class="flex-grow-1 overflow-auto p-4">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import Slider from '../../components/desktop/Slider.vue';
import TopBar from '../../components/desktop/TopBar.vue';

const isCollapsed = ref(false);

const toggleSidebar = () => {
    isCollapsed.value = !isCollapsed.value;
}
</script>

<style scoped>
.d-flex.flex-column.flex-grow-1 {
    width: calc(100% - var(--slider-width));
    transition: width 0.3s ease;
}

.d-flex.flex-column.flex-grow-1.expanded {
    width: 100%;
}
</style>
