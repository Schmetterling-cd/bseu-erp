<template>
    <PageTitle :title="'Текущая аттестация'" :subtitle="'Аттестация'" />
    <PageCard :title="'Фильтр'" :title-font-size="'1.5rem'">
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="form-check form-switch">
                <input class="form-check-input cursor-pointer" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                    v-model="isChecked">
                <label class="form-check-label">
                    {{ isChecked ? ui.mode.group : ui.mode.subject }}
                </label>
            </div>

            <Search style="width: 250px;" placeholder="Поиск"
                @search="(query) => { console.log('Search query:', query); }" />
        </div>
    </PageCard>

    <PageSlider :title="'Алгоритмизация и программирование'" :expanded="true">
        <PageTable :controller="'current-attestation'" :action="'getList'" :actions="tableActions"/>
    </PageSlider>
</template>

<script setup>
import PageTitle from '../../components/desktop/PageTitle.vue';
import Search from '../../components/desktop/Search.vue';
import PageTable from '../../components/desktop/PageTable.vue';
import { ref, reactive } from 'vue';
import PageSlider from '../../components/desktop/PageSlider.vue';
import PageCard from '../../components/desktop/PageCard.vue';

const isChecked = ref(false);

const ui = reactive({
    mode: {
        subject: 'По предмету',
        group: 'По группе'
    }
});

const tableActions = [
    {
        name: 'open',
        action: (id) => {
            console.log('open: ' + id);
        }
    }
];

const tableData = reactive([
        {
          groupNumber: "25д.дн/2",
          group: 1,
          subjects: "Перечисление предметов",
          endDate: "22/02/2025",
          attestation: 0
        },
        {
          groupNumber: "25д.дн/1",
          group: 1,
          subjects: "Перечисление предметов",
          endDate: "24/12/2024",
          attestation: 0
        },
        {
          groupNumber: "24д.дн/2",
          group: 2,
          subjects: "Перечисление предметов",
          endDate: "20/12/2024",
          attestation: 0
        }
      ]);
</script>

<style scoped></style>
