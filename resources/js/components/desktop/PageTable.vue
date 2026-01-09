<template>
    <div class="table-actions d-flex justify-content-between align-items-center mb-2">
        <Search style="width: 250px;" placeholder="Поиск"
            @search="(query) => { console.log('Search query:', query); }" />

        <div class="d-flex align-items-center gap-2 h-100">
            <div class="text-secondary font-size-0-875-rem">
                {{ pageInfo }}
            </div>

            <PaginationControl :current-page="tablePagination.currentPage" :total-pages="tablePagination.totalPages"
                @fetch-records="fetchRecords()"></PaginationControl>
            <BseuSelect :value="tablePagination.itemsPerPage"></BseuSelect>
            <BseuButton :label="'Добавить'" :icon="'bi-plus-circle'" @click="() => { console.log('Click'); }" />
        </div>
    </div>

    <div class="overflow-hidden shadow-sm border border-1 border-secondary border-opacity-10">
        <div class="overflow-auto bseu-crm-scrollbar">
            <table class="table table-striped table-bordered pb-0 mb-0">
                <thead>
                    <tr>
                        <th scope="col" v-for="header in table.headers">
                            {{ header.label }}
                            <span class="sort-icon" v-if="header.isSortable && sortField === header.name"
                                @click="sortBy(header.name)">
                                {{ tableFilters.sortDirection === 'asc' ? '↑' : '↓' }}
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <tr v-for="row in table.data" :key="row.id">
                        <td v-for="header in table.headers">
                            <IconButton class="w-100" v-if="header.isAction && hasAction(header.name)"
                                @click="getActionByName(header.name).action(row.id)">
                                <i :class="'bi ' + row[header.name]"></i>
                            </IconButton>
                            <p class="my-0 mx-0" v-else>{{ row[header.name] }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>


            <!-- <Spinner v-if="fetchTable"></Spinner> -->

            <div v-if="table.data.length === 0 && !fetchTable">
                <p>{{ searchQuery ? 'Data not found' : 'No records' }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
// import Spinner from "./Spinner.vue";
import requester from "../../modules/requester";
import Search from "./Search.vue";
import BseuButton from "./BseuButton.vue";
import BseuSelect from "./BseuSelect.vue";
import PaginationControl from "./PaginationControl.vue";
import IconButton from "./IconButton.vue";
import { reactive, ref, onMounted } from "vue";

const props = defineProps({
    controller: {
        type: String,
        required: true
    },
    action: {
        type: String,
        required: true
    },
    actions: {
        type: Array,
        default: null
    }
});

const tablePagination = reactive({
    currentPage: 1,
    itemsPerPage: 5,
    totalPages: 1,
    startItem: 1,
    endItem: 1,
    totalItems: 1,
    pageInfo: null
});

const tableFilters = reactive({
    searchQuery: '',
    sortField: 'updated_at',
    sortDirection: 'desc',
});

const table = reactive({
    headers: [],
    data: [],
});

const fetchTable = ref(false);

const fetchRecords = () => {
    const requestUrl = '/api/' + props.controller + '/' + props.action;
    const params = {
        page: tablePagination.currentPage,
        size: tablePagination.itemsPerPage,
        sortBy: tableFilters.sortField,
        sortOrder: tableFilters.sortDirection,
        searchQuery: tableFilters.searchQuery,
    };

    table.headers = [
        {
            priority: 1,
            name: 'open',
            label: null,
            isSortable: false,
            isAction: true
        },
        {
            priority: 2,
            name: 'group_number',
            label: 'Номер группы',
            isSortable: false,
            isAction: false
        },
        {
            priority: 3,
            name: 'course',
            label: 'Курс',
            isSortable: true,
            isAction: false
        },
        {
            priority: 4,
            name: 'is_accomplieshed',
            label: 'Аттестация окончена',
            isSortable: false,
            isAction: false
        },
    ];

    table.data = [
        {
            id: 1,
            open: 'bi-folder',
            group_number: '25-ДЦИ-2',
            course: '1',
            is_accomplieshed: 'Да'
        }
    ];

    // fetchTable = true;

    // requester.sendGetWithoutBlock(requestUrl, { params: params })
    //     .then(response => {
    //         const meta = response.meta;

    //         tablePagination.totalPages = meta.last_page;
    //         tablePagination.currentPage = meta.current_page;
    //         tablePagination.startItem = meta.from;
    //         tablePagination.endItem = meta.to;
    //         tablePagination.totalItems = meta.total;

    //         tablePagination.pageInfo = response.ui.page_info;

    //         table.headers = response.headers;
    //         table.data = response.data;

    //         fetchTable = false;
    //     });
};

const hasAction = (actionName) => {
    return props.actions.some(action => action.name === actionName);
};

const getActionByName = (actionName) => {
    return props.actions.find(action => action.name === actionName);
};

const sortBy = (field) => {
    if (tableFilters.sortField === field) {
        tableFilters.sortDirection = tableFilters.sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
        tableFilters.sortField = field;
        tableFilters.sortDirection = 'asc';
    }

    resetToFirstPage()
};

const resetToFirstPage = () => {
    tablePagination.currentPage = 1;
    fetchRecords();
};

const handleSearch = () => {
    this.resetToFirstPage();
};

onMounted(() => {
    fetchRecords();
});
</script>

<style scoped></style>
