<template>
    <CardLayout
        :style="{
                   minWidth: 'max-content',
                   minHeight: 'max-content',
               }"
        :class="['d-flex flex-column justify-content-center align-items-center gap-3']"
    >
        <Logo :style="{ maxWidth: '100px',}"/>
        <h2>{{ props.title }}</h2>

        <form class="d-grid gap-3" :style="{ width: '300px' }">
            <slot></slot>
        </form>

        <div class="login-footer d-flex flex-column align-items-center justify-content-center">
            <slot name="footer"></slot>
        </div>
    </CardLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import Logo from '../../components/desktop/Logo.vue';
import LoginLayout from "./LoginLayout.vue";
import CardLayout from "./CardLayout.vue";

const props = defineProps({
    title: {
        type: String,
        required: true
    }
});
</script>

<style scoped>
</style>
