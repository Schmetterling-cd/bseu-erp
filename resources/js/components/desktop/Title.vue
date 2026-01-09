<template>
    <div class="w-100 d-flex flex-column justify-content-centr align-items-start h-100">
        <h1 class="page-title px-0 py-0 mx-0 my-0" :style="{ fontSize: fontSize }">
            <slot name="icon-left">
                <i :class="['bi', icon, 'me-2']"></i>
            </slot>
            {{ title }}
            <span v-if="subtitle" class="title-divider"></span>
        </h1>
        <p v-if="subtitle" class="page-subtitle text-muted py-0 my-0 pt-3">{{ subtitle }}</p>
    </div>
</template>

<script setup>
const props = defineProps({
    title: {
        type: String,
        default: 'Раздел системы'
    },
    subtitle: {
        type: String,
        default: null,
    },
    fontSize: {
        type: String,
        default: '2rem'
    },
    icon: {
        type: String,
        default: 'bi-folder'
    }
});
</script>

<style scoped>
.page-title {
    font-size: 2rem;
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
