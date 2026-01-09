<template>
    <PageComponentLayout class="px-0 py-0">
        <PageSubTitle class="cursor-pointer" :title="title" :with-toggle="true" :is-expanded="isExpanded" @click="toggle"/>

        <div class="simple-collapse" :class="{ 'expanded': isExpanded }">
            <div class="px-3 py-2 w-100">
                <slot></slot>
            </div>
        </div>
    </PageComponentLayout>
</template>

<script setup>
import { ref } from 'vue';
import PageComponentLayout from '../../layouts/desktop/PageComponentLayout.vue';
import PageSubTitle from './PageSubTitle.vue';

const props = defineProps({
    title: {
        type: String,
        required: true
    }
})

const isExpanded = ref(false);

const toggle = () => {
    isExpanded.value = !isExpanded.value;
}
</script>

<style scoped>
.simple-collapse {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.simple-collapse.expanded {
    min-height: min-content;
    max-height: max-content;
}
</style>
