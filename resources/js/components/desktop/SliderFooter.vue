<template>
    <div class="d-flex flex-row align-items-center px-2 py-2 h-55-px">
        <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
        <div class="d-flex flex-column justify-content-center align-items-start text-white">
            <p class="px-0 py-0 mx-0 my-0 font-size-0-9-rem">{{ user.fullName }}</p>
            <small class="px-0 py-0 mx-0 my-0 font-size-0-75-rem">({{ $t('role.' + user.role) }})</small>
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from 'vuex';

const store = useStore();
const user = computed(() => store.state.user.user);
</script>

<style scoped></style>
