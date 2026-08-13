<template>
    <div class="d-flex flex-row justify-content-center align-items-center px-2 py-2 h-55-px bg-semi-dark">
        <p class="px-0 py-0 mx-0 my-0 font-size-0-9-rem">{{ $t('department.' + user.department) }}</p>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from 'vuex';

const store = useStore();
const user = computed(() => store.state.user.user);
</script>

<style scoped></style>
