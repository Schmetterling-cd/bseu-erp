<template>
    <select :value="value" class="form-select select">
        <option v-for="option in options" :value="option.value">{{ option.text }}</option>
    </select>
</template>

<script setup>
import { onBeforeMount } from 'vue';

const props = defineProps({
    options: {
        type: Array,
        default: () => [
            { value: 5, text: '5' },
            { value: 10, text: '10' },
            { value: 20, text: '20' },
            { value: 50, text: '50' },
        ]
    },
    value: {
        type: [String, Number],
        default: null
    }
});

onBeforeMount(() => {
    if (!props.value && props.options.length > 0) {
        itemsPerPage = props.options[0].value;
    }
});
</script>

<style scoped>
.select {
    max-width: max-content;
}
</style>
