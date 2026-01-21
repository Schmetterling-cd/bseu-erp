<template>
    <select :value="modelValue" class="form-select select" @change="handleChange">
        <option v-for="option in options" :key="option.value" :value="option.value" :selected="option.value === value">
            {{ option.label }}</option>
    </select>
</template>

<script setup>
import { onBeforeMount } from 'vue';

const props = defineProps({
    options: {
        type: Array,
        default: () => [
            { value: 5, label: '5' },
            { value: 10, label: '10' },
            { value: 20, label: '20' },
            { value: 50, label: '50' },
        ]
    },
    modelValue: {
        type: [String, Number]
    }
});

const emit = defineEmits(['update:modelValue']); // ← это должно быть update:modelValue

const handleChange = (event) => {
    emit('update:modelValue', event.target.value);
};

onBeforeMount(() => {
    if (!props.value && props.options.length > 0) {
        props.value = props.options[0].value;
    }
});
</script>

<style scoped>
.select {
    max-width: max-content;
}
</style>
