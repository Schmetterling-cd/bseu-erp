<template>
    <PageTitle :title="'Текущая аттестация'" :subtitle="'Аттестация'" />
    <PageCard :title="'Список групп'" :title-font-size="'1.5rem'">
        <PageTable :controller="'current-attestation'" :action="'getList'" :actions="tableActions" />
    </PageCard>
</template>

<script setup>
import PageTitle from '../../components/desktop/PageTitle.vue';
import PageTable from '../../components/desktop/PageTable.vue';
import PageCard from '../../components/desktop/PageCard.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const tableActions = [
    {
        name: 'open',
        action: (id) => {
            router.push('/current-attestation/card/' + id);
        }
    }
];
</script>

<style scoped></style>
