<template>
    <AuthenticationLayout :title="$t('authentication.login')">
        <div class="form-group">
            <label>{{ $t('common.email') }}</label>
            <Input
                v-model="form.email"
                type="text"
                placeholder="your@email.com"
                name="email"
            />
        </div>

        <PasswordInput
            name="password"
            v-model="form.password"
            :label="$t('common.password')"
        />

        <SystemButton class="main-system-button" :button-text="$t('common.submit')" @click="() => { console.log(form) }"/>

        <template #footer>
            <a href="/password-recovery">Забыли пароль?</a>
            <p class="mb-0">
                {{ $t('authentication.dont_have_an_account') }}
            </p>
            <a href="/register">{{ $t('authentication.register') }}</a>
        </template>
    </AuthenticationLayout>
</template>

<script setup>
import AuthenticationLayout from "../../../layouts/desktop/AuthenticationLayout.vue";
import { reactive } from "vue";
import Input from "../../../components/desktop/inputs/Input.vue";
import PasswordInput from "../../../components/desktop/inputs/PasswordInput.vue";
import SystemButton from "../../../components/desktop/buttons/SystemButton.vue";

const form = reactive({
    email: "",
    password: ""
});
</script>

<style scoped>

</style>
