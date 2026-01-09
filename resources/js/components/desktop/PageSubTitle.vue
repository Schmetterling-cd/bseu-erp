<template>
    <div class="text-primary-emphasis px-3 py-2 w-100 d-flex flex-column justify-content-centr align-items-start h-100">
        <div class="w-100 d-flex justify-content-between align-items-center py-2">
            <h1 class="page-title px-0 py-0 mx-0 my-0" :style="{ fontSize: fontSize }">
                <i v-if="icon" :class="['bi', icon, 'me-2']"></i>
                {{ title }}
            </h1>

            <i v-if="withToggle" :class="['bi', arrowIcon, 'text-muted']"></i>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Раздел системы'
    },
    fontSize: {
        type: String,
        default: '1.1rem'
    },
    icon: {
        type: String,
        default: 'bi-folder'
    },
    withToggle: {
        type: Boolean,
        default: false
    },
    isExpanded: {
        type: Boolean,
        default: false
    }
});

const arrowIcon = computed(() => {
    return props.isExpanded ? 'bi-chevron-up' : 'bi-chevron-down'
});
</script>

<style scoped>
.page-title {
    font-weight: 600;
    position: relative;
}

.title-divider {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--main-bseu-color), #3498db);
    border-radius: 2px;
}

.page-subtitle {
    font-size: 1.1rem;
}
</style>

