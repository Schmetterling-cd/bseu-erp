<template>
    <PageComponentLayout class="px-4 py-3">
        <Title :title="title" :subtitle="subtitle" />
    </PageComponentLayout>
</template>

<script setup>
import PageComponentLayout from '../../layouts/desktop/PageComponentLayout.vue';
import Title from './Title.vue';

const props = defineProps({
    title: {
        type: String,
        default: 'Раздел системы'
    },
    subtitle: {
        type: String,
        default: null
    }
});
</script>

<style scoped></style>
