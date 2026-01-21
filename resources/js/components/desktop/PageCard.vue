<template>
    <PageComponentLayout class="px-0 py-0">
        <PageSubTitle :title="title" :font-size="titleFontSize" :icon="icon" />
        <div class="px-3 py-2 w-100">
            <slot></slot>
        </div>
    </PageComponentLayout>
</template>

<script setup>
import PageComponentLayout from '../../layouts/desktop/PageComponentLayout.vue';
import PageSubTitle from './PageSubTitle.vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    titleFontSize: {
        type: String,
        required: true
    },
    icon: {
        type: String,
        default: 'bi-journal-text'
    }
});
</script>

<style scoped></style>
