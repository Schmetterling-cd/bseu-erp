<template>
    <AppLayout v-if="isAuthenticated" class="h-100-vh">
        <router-view></router-view>
    </AppLayout>
    <LoginLayout v-else>
        <router-view></router-view>
    </LoginLayout>
</template>

<script setup>
import AppLayout from './layouts/desktop/AppLayout.vue';
import { computed } from "vue";
import { useStore } from 'vuex';
import LoginLayout from "./layouts/desktop/LoginLayout.vue";

const store = useStore();
const isAuthenticated = computed(() => store.state.user.isAuthenticated);
</script>

<style>
body {
  margin: 0;
  padding: 0;
}

</style>
