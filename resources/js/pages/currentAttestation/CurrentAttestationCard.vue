<template>
    <PageTitle :title="'Текущая аттестация'" :subtitle="'25ДЦИ-2'" />
    <PageCard :title="'Журнал'" :title-font-size="'1.5rem'" :icon="'bi-journal-text'">
        <div class="form-check form-switch">
            <input class="form-check-input cursor-pointer" type="checkbox" role="switch" id="flexSwitchCheckDefault"
                v-model="isChecked">
            <label class="form-check-label">
                {{ isChecked ? 'Оценка' : 'Зачтено/не зачтено' }}
            </label>
        </div>
        <PosInlineTable :headers="headers" :data="data" />
    </PageCard>

    <PageComponentLayout class="d-flex d-row gap-1 page-actions">
        <BseuButton :label="'Сохранить'" @click="saveData"></BseuButton>
        <button
            class="add-btn h-100 translate-y-n1-on-hover font-size-0-75-rem font-weight-500 px-3 py-0 mx-0 my-0 bg-secondary text-white border border-0 rounded-3 cursor-pointer d-flex flex-row justify-content-center align-items-center">
            <i v-if="icon" :class="'bi ' + icon"></i>
            Отмена
        </button>
    </PageComponentLayout>
</template>

<script setup>
import PageTitle from '../../components/desktop/PageTitle.vue';
import PageCard from '../../components/desktop/PageCard.vue';
import PosInlineTable from '../../components/desktop/PosInlineTable.vue';
import { reactive, ref, watch } from 'vue';
import BseuButton from '../../components/desktop/BseuButton.vue';
import PageComponentLayout from '../../layouts/desktop/PageComponentLayout.vue';

const headers = reactive([
    [
        {
            priority: 0,
            name: 'test1',
            type: 'string',
            isEditable: false,
            label: '',
            isSortable: false
        },
        {
            priority: 0,
            name: 'test2',
            type: 'string',
            isEditable: false,
            label: '',
            isSortable: false
        },
        {
            priority: 0,
            name: 'test3',
            type: 'string',
            isEditable: false,
            label: 'Алгоритмизация и программирование',
            isSortable: false,
            colspan: 3
        },
        {
            priority: 0,
            name: 'header_subject_2',
            type: 'string',
            isEditable: false,
            label: 'Искусственный интелект',
            isSortable: false,
            colspan: 3
        },
        {
            priority: 0,
            name: 'header_subject_3',
            type: 'string',
            isEditable: false,
            label: 'Реинженеринг бизнесс-процессов',
            isSortable: false,
            colspan: 3
        },
    ],
    [
        {
            priority: 1,
            name: 'number',
            type: 'int',
            isEditable: false,
            label: '№',
            isSortable: true
        },
        {
            priority: 2,
            name: 'full_name',
            label: 'ФИО',
            type: 'string',
            isEditable: false,
            isSortable: true,
        },
        {
            priority: 3,
            name: 'subject_mark_1',
            label: 'Оценка',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_undelivered_1',
            label: 'Не сдано',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_skiped_1',
            label: 'Пропущено (ч.)',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 4,
            name: 'subject_mark_2',
            label: 'Оценка',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_undelivered_2',
            label: 'Не сдано',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_skiped_2',
            label: 'Пропущено (ч.)',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 5,
            name: 'subject_mark_3',
            label: 'Оценка',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_undelivered_3',
            label: 'Не сдано',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
        {
            priority: 3,
            name: 'subject_skiped_3',
            label: 'Пропущено (ч.)',
            isEditable: true,
            isSortable: false,
            type: 'int'
        },
    ]
]);

const data = reactive([
    {
        number: 1,
        full_name: 'Алексеёнок Илья Юрьевич',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 2,
        full_name: 'Вериго Вадим Витальевич',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 3,
        full_name: 'Власенко Евгения Ильинична',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 4,
        full_name: 'Галимова Диана Артуровна',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 5,
        full_name: 'Гришин Андрей Николаевич',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 6,
        full_name: 'Доморацкий Марк Анатольевич',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 7,
        full_name: 'Дубинец Ксения Андреевна',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 8,
        full_name: 'Дубовский Савелий Владимирович',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 9,
        full_name: 'Зайко Нина Владимировна',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 10,
        full_name: 'Камышников Макар Александрович',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
    {
        number: 11,
        full_name: 'Капустина Мария Владиславовна',
        subject_mark_1: 4,
        subject_undelivered_1: 1,
        subject_skiped_1: 2,
        subject_mark_2: 5,
        subject_undelivered_2: 1,
        subject_skiped_2: 2,
        subject_mark_3: null,
        subject_undelivered_3: 1,
        subject_skiped_3: 2
    },
]);

const isChecked = ref(true);
const subjectNames = headers.flat().filter(field => field.name.startsWith('subject_mark_')).map(field => field.name);

watch(isChecked, (newValue) => {
    data.forEach((row) => {
        subjectNames.forEach((subjectName) => {
            if (newValue) {
                row[subjectName] = row[subjectName] === 'pass' ? 4 : null;
            } else {
                row[subjectName] = row[subjectName] >= 4 ? 'pass' : 'not_pass';
            }

            const header = headers.flat().find(head => head.name === subjectName);
            header.type = newValue ? 'int' : 'lookup';
        });
    });
});

const saveData = () => {
    console.log(data);
};
</script>

<style scoped>
.page-actions {
    height: 75px !important;
}
</style>
