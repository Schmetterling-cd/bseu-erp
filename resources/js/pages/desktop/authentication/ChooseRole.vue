<template>
    <AuthenticationLayout title="Выбор роли">
        <ScrollLayout style="max-height: 300px;">
            <li
                v-for="(role, index) in roles"
                :key="role.code"
                class="variant d-flex align-items-center border border-start-0 border-end-0 px-3 py-3"
                :class="index !== 0 ? 'border-top-0' : ''"
            >
                <span>{{ role.label }}</span>
            </li>
        </ScrollLayout>
    </AuthenticationLayout>
</template>

<script setup>
import AuthenticationLayout from "../../../layouts/desktop/AuthenticationLayout.vue";
import ScrollLayout from "../../../layouts/desktop/ScrollLayout.vue";

const roles = [
    {
        label: 'Роль',
        code: 'role'
    },
    {
        label: 'Роль',
        code: 'role1'
    },
    {
        label: 'Роль',
        code: 'role2'
    },
    {
        label: 'Роль',
        code: 'role3'
    },
    {
        label: 'Роль',
        code: 'role4'
    },
    {
        label: 'Роль',
        code: 'role5'
    },
    {
        label: 'Роль',
        code: 'role6'
    },
    {
        label: 'Роль',
        code: 'role7'
    },
];
</script>

<style scoped>
.variant {
    cursor: pointer;
    transition: all 0.2s ease;
}

.variant:hover {
    background-color: var(--bs-tertiary-color) !important;
    color: white;
}
</style>
