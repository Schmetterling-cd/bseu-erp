<template>
    <AuthenticationLayout :title="$t('authentication.password_recovery')">
        <EmailSent v-if="isSent">
            <p class="text-center m-0">{{ $t('password.sent_email_to_reset') }}</p>
            <strong class="text-center">{{ form.email }}</strong>
            <p class="text-center">{{ $t('email.follow_link') }}</p>
        </EmailSent>

        <p v-else class="form-message text-center">
            {{ $t('password.enter_email_to_reset') }}
        </p>

        <div v-if="!isSent" class="form-group">
            <label>{{ $t('common.email') }}</label>
            <Input
                v-model="form.email"
                placeholder="your@email.com"
                name="email"
                type="email"
            />
        </div>

        <SystemButton :button-text="buttonText" class="main-system-button" @click="sendForm"/>

        <template #footer>
            <p class="mb-0">
                {{ $t('authentication.remember_password') }}
            </p>

            <a href="/login">{{ $t('authentication.login') }}</a>
        </template>
    </AuthenticationLayout>
</template>

<script setup>
import { ref, reactive, computed } from 'vue';
import Input from "../../../components/desktop/inputs/Input.vue";
import AuthenticationLayout from "../../../layouts/desktop/AuthenticationLayout.vue";
import SystemButton from "../../../components/desktop/buttons/SystemButton.vue";
import {useI18n} from "vue-i18n";
import EmailSent from "../../../components/desktop/email/EmailSent.vue";

const form = reactive({
    email: ''
});

const isSent = ref(false);

const sendForm = () => {
    isSent.value = true;
};

const { t } = useI18n();

const buttonText = computed(() => {
    return isSent.value ? t('email.resend_the_link') : t('email.send_a_link');
});
</script>

<style scoped>
</style>
