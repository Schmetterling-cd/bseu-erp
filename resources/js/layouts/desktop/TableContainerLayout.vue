<template>
    <div class="overflow-hidden shadow-sm border border-1 border-secondary border-opacity-10">
        <div class="overflow-auto bseu-crm-scrollbar">
            <table class="table table-striped table-bordered pb-0 mb-0">
                <thead>
                    <tr v-for="columnHeaders in headers">
                        <th :colspan="header.colspan ?? 1" class="col align-middle" v-for="header in columnHeaders" :class="{ 'cursor-pointer' : header.isSortable }">
                            {{ header.label }}
                            <span class="sort-icon" v-if="header.isSortable && sortField === header.name"
                                @click="sortBy(header.name)">
                                {{ tableFilters.sortDirection === 'asc' ? '↑' : '↓' }}
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <slot></slot>
                </tbody>
            </table>


            <!-- <Spinner v-if="fetchTable"></Spinner> -->

            <!-- <div class="d-flex flex-column justify-content-centr align-items-center" v-if="data.length === 0 && !fetchTable">
                <p>{{ searchQuery ? 'Data not found' : 'No records' }}</p>
            </div> -->
        </div>
    </div>
</template>

<script setup>
import { reactive } from 'vue';

const props = defineProps({
    headers: {
        type: Array,
        required: true
    },
});

const tableFilters = reactive({
    searchQuery: '',
    sortField: 'updated_at',
    sortDirection: 'desc',
});

const sortBy = (field) => {
    if (tableFilters.sortField === field) {
        tableFilters.sortDirection = tableFilters.sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        tableFilters.sortField = field;
        tableFilters.sortDirection = 'asc';
    }

    sort();
};

const sort = () => {
    console.log('sort');
};
</script>

<style scoped></style>
