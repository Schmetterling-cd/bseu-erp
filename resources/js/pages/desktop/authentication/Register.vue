<template>
    <AuthenticationLayout :title="$t('authentication.register')">
        <div class="form-group">
            <label>{{ $t('common.email') }}</label>
            <Input
                v-model="form.email"
                type="email"
                placeholder="your@email.com"
                name="email"
            />
        </div>

        <PasswordInput
            name="password"
            v-model="form.password"
            :label="$t('common.password')"
        />

        <PasswordInput
            name="confirm_password"
            v-model="form.confirm_password"
            :label="$t('authentication.confirm_password')"
            :is-invalid="!passwordMatch"
        />

        <SystemButton class="main-system-button" :button-text="$t('common.submit')" @click="() => { console.log(form) }"/>

        <template #footer>
            <p class="mb-0">
                {{ $t('authentication.have_an_account') }}
            </p>
            <a href="/login">{{ $t('authentication.login') }}</a>
        </template>
    </AuthenticationLayout>
</template>

<script setup>
import { reactive, ref, watch } from 'vue';
import AuthenticationLayout from "../../../layouts/desktop/AuthenticationLayout.vue";
import Input from "../../../components/desktop/inputs/Input.vue";
import PasswordInput from "../../../components/desktop/inputs/PasswordInput.vue";
import SystemButton from "../../../components/desktop/buttons/SystemButton.vue";

const form = reactive({
    email: '',
    password: '',
    confirm_password: ''
});

const passwordMatch = ref(true);

watch(
    () => [form.password, form.confirm_password],
    ([password, confirmPassword]) => {
        if (password !== '' && confirmPassword !== '') {
            passwordMatch.value = password === confirmPassword;
        } else {
            passwordMatch.value = true;
        }
    },
    { immediate: true, deep: true }
);
</script>

<style scoped>

</style>
