<template>
    <div class="form-message d-grid gap-1">
        <slot></slot>

        <div class="d-flex flex-column align-items-start">
            <h5>{{ $t('email.didnt_receive') }}</h5>

            <ul class="d-flex flex-column align-items-start">
                <li>{{ $t('email.check_spam') }}</li>
                <li>{{ $t('email.sure_email_is_correct') }}</li>
                <li>{{ $t('common.please_wait') }}</li>
            </ul>
        </div>
    </div>
</template>

<script setup>

</script>

<style scoped>

</style>
