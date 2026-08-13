<template>
    <div
            class="d-flex justify-content-center align-items-center position-fixed top-0 start-0 w-100 h-100 login-layout"
            :style="{
                backgroundColor: 'var(--main-system-color)',
                zIndex: 9998
            }"
        >
            <slot></slot>
        </div>
</template>

<script setup>

</script>

<style scoped>
.login-layout {
    background-color: var(--main-system-color);
    z-index: 9998;
}
</style>
