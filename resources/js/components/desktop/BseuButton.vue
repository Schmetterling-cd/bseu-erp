<template>
    <button
        class="add-btn h-100 translate-y-n1-on-hover font-size-0-75-rem font-weight-500 px-3 py-0 mx-0 my-0 background-bseu text-white border border-0 rounded-3 cursor-pointer d-flex flex-row justify-content-center align-items-center"
        @click="handleAdd">
        <i v-if="icon" :class="'bi ' + icon"></i>
        {{ label }}
    </button>
</template>

<script setup>
const props = defineProps({
    label: {
        type: String,
        default: 'Раздел системы'
    },
    icon: {
        type: String,
        default: null,
    },
});
</script>

<style scoped>
.add-btn {
    max-height: 75px;
    min-height: 40px;
    min-width: max-content;
    transition: all 0.2s ease;
    gap: 0.5rem;
}
</style>
