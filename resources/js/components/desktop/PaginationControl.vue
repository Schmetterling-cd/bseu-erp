<template>
    <div class="pagination-controls">
        <IconButton :disabled="currentPage === 1" @click="changePage(currentPage - 1)">
            <i class="bi bi-chevron-left"></i>
        </IconButton>

        <div class="d-flex align-items-center gap-1">
            <button v-for="page in visiblePages" :key="page" type="button"
                class="btn btn-light border border-1 translate-y-n1-on-hover"
                :class="{ 'background-bseu': page === currentPage, 'text-white': page === currentPage }"
                @click="changePage(page)">
                {{ page }}
            </button>
            <span v-if="showEllipsis" class="page-ellipsis">...</span>
        </div>

        <IconButton :disabled="currentPage === totalPages" @click="changePage(currentPage + 1)">
            <i class="bi bi-chevron-right"></i>
        </IconButton>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import IconButton from './IconButton.vue';

const props = defineProps({
    currentPage: {
        type: Number,
        required: true
    },
    totalPages: {
        type: Number,
        required: true
    },
});

const visiblePages = computed(() => {
    const pages = [];
    let start = Math.max(1, props.currentPage - 2);
    let end = Math.min(props.totalPages, start + 4);

    if (end - start < 4) {
        start = Math.max(1, end - 4);
    }

    for (let i = start; i <= end; i++) {
        pages.push(i);
    }

    return pages;
});

const showEllipsis = computed(() => {
    return props.totalPages > 5 && props.currentPage < props.totalPages - 2
});

const changePage = (page) => {
    if (page >= 1 && page <= props.totalPages) {
        props.currentPage = page;
        fetchRecords();
    }
};

const fetchRecords = () => {
    emit('fetch-records');
};
</script>

<style scoped>
.pagination-controls {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
</style>
