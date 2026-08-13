<template>
    <input
        :placeholder="placeholder"
        :class="['my-0 mx-0 form-control', classMapper[type] || '']"
        v-model="inputValue"
        :name="name"
        :type="type"
    />
</template>

<script setup>
import { computed, defineProps, defineEmits } from 'vue';

const props = defineProps({
    modelValue: {
        type: [String, Number],
        default: ''
    },
    type: {
        type: String,
        default: 'text'
    },
    placeholder: {
        type: String,
        default: ''
    },
    name: {
        type: String,
        default: ''
    }
})

const emit = defineEmits(['update:modelValue']);

const classMapper = {
    'number': 'text-end',
    'text': 'text-start',
};

const inputValue = computed({
    get: () => props.modelValue,
    set: (value) => {
        if (props.type === 'number') {
            value = value.replace(/[^0-9]/g, '')
        }
        emit('update:modelValue', value);
    }
})
</script>

<style scoped>
</style>
