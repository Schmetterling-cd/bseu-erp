<template>
    <div class="table-actions d-flex justify-content-between align-items-center mb-2">
        <Search style="width: 250px;" placeholder="Поиск" @search="handleSearch" />

        <div class="d-flex align-items-center gap-2 h-100">
            <BseuButton v-if="false" :label="'Добавить'" :icon="'bi-plus-circle'"
                @click="() => { console.log('Click'); }" />
        </div>
    </div>

    <TableContainerLayout :headers="headers">
        <tr v-if="data.length > 0" v-for="row in data" :key="row.id">
            <td v-for="header in contentHeaders" :class="{ 'align-middle': header.isAction }">
                <p class="my-0 mx-0" v-if="!header.isEditable">{{ row[header.name] }}</p>
                <input class="form-control" v-else-if="inputFieldTypes.includes(header.type)"
                    v-model="row[header.name]" />
                <BseuSelect v-else-if="selectFieldTypes.includes(header.type)" :options="options"
                    v-model="row[header.name]" />
            </td>
        </tr>
    </TableContainerLayout>
</template>

<script setup>
// import Spinner from "./Spinner.vue";
import Search from "./Search.vue";
import BseuButton from "./BseuButton.vue";
import BseuSelect from "./BseuSelect.vue";
import TableContainerLayout from "../../layouts/desktop/TableContainerLayout.vue";
import { computed } from "vue";

const props = defineProps({
    headers: {
        type: Array,
        required: true
    },
    data: {
        type: Array,
        required: true,
    },
});

const inputFieldTypes = ['int', 'string'];
const selectFieldTypes = ['lookup'];

const options = [
    { value: 'pass', label: 'Зачтено' },
    { value: 'not_pass', label: 'Не зачтено' },
];

const handleSearch = (query) => { console.log('Search query:', query); };
const contentHeaders = computed(() => {
    const keys = Object.keys(props.data[0]);
    console.log(keys);

    return props.headers.flat().filter((header) => {
        return keys.includes(header.name);
    });
});
</script>

<style scoped></style>
