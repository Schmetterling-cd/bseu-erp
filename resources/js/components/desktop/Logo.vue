<template>
    <div class="border-bottom border-secondary">
        <div class="d-flex flex-column align-items-center">
            <img :src="LogoImg" alt="Logo" :style="{
                width: width,
                maxWidth: '100%',
                objectFit: 'cover'
            }">
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';
import LogoImg from '../../../assets/images/logo.png';

const props = defineProps({
    width: {
        type: String,
        default: '350px'
    },
});
</script>

<style scoped></style>
