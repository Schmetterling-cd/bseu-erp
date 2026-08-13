<template>
    <AuthenticationLayout :title="$t('authentication.email_verification')">
        <EmailSent>
            <p class="text-center m-0">{{ $t('password.sent_email_to_approve') }}</p>
            <strong class="text-center">{{ user.email }}</strong>
            <p class="text-center">{{ $t('email.follow_link') }}</p>
        </EmailSent>

        <SystemButton
            :button-text="$t('email.resend_the_link')"
            class="main-system-button"
            @click="() => {console.log('Sent')}"
        />

        <template #footer>
            <a href="/">{{ $t('authentication.email_confirmed') }}</a>
        </template>
    </AuthenticationLayout>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from 'vuex';
import AuthenticationLayout from "../../../layouts/desktop/AuthenticationLayout.vue";
import EmailSent from "../../../components/desktop/email/EmailSent.vue";
import SystemButton from "../../../components/desktop/buttons/SystemButton.vue";

const store = useStore();
const user = computed(() => store.state.user.user);
</script>

<style scoped>
</style>
