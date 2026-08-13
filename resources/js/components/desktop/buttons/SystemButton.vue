<template>
    <button type="button" class="btn">{{ props.buttonText }}</button>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
    buttonText: {
        type: String,
        required: true
    }
});
</script>

<style scoped>

</style>
