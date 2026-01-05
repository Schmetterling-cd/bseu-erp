<template>
    <div class="nav-group">
        <button
            class="btn btn-toggle align-items-center rounded w-100 text-start text-white p-3 border-0 d-flex justify-content-between"
            :class="{
                'collapsed': !group.active,
                'bg-dark': !group.active,
                'bg-dark-subtle': group.active,
                'has-active': hasActiveItem
            }"
            @click="handleToggle"
        >
            <div class="d-flex align-items-center">
                <i v-if="group.icon" :class="['bi', group.icon, 'me-3']"></i>
                <span class="fw-medium">{{ group.title }}</span>
            </div>
            <i v-if="!hasActiveItem" :class="['bi', group.active ? 'bi-chevron-up' : 'bi-chevron-down', 'text-white-50']"></i>
        </button>

        <div class="accordion-content" :class="{ 'expanded': group.active }">
            <ul class="btn-toggle-nav list-unstyled fw-normal ps-4 small mb-0 bg-dark">
                <li v-for="item in group.items" :key="item.id">
                    <NavLink
                        :link="item"
                        :active="item.active"
                        @click="handleItemClick(item)"
                    />
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import NavLink from './NavLink.vue';
import { defineProps, defineEmits, computed } from 'vue';

const props = defineProps({
    group: {
        type: Object,
        required: true
    }
});

const emit = defineEmits(['item-click', 'toggle']);

// Проверяем, есть ли активный элемент в этой группе
const hasActiveItem = computed(() => {
    return props.group.items.some(item => item.active);
});

// Обработчик переключения группы
const handleToggle = () => {
    emit('toggle', props.group.uuid);
};

// Обработчик клика по элементу группы
const handleItemClick = (item) => {
    emit('item-click', item);
};
</script>

<style scoped>
.nav-group {
    background-color: transparent;
}

.btn-toggle {
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-toggle:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
}

.btn-toggle:focus {
    box-shadow: none;
    outline: none;
}

.bg-dark-subtle {
    background-color: rgba(255, 255, 255, 0.05) !important;
}

.has-active {
    border-left: 3px solid var(--main-bseu-color);
}

.btn-toggle-nav .nav-link {
    color: rgba(255, 255, 255, 0.8);
    transition: all 0.2s ease;
    text-decoration: none;
    cursor: pointer;
}

.btn-toggle-nav .nav-link:hover:not(.active) {
    background-color: rgba(255, 255, 255, 0.05);
    color: white;
}

.btn-toggle-nav .nav-link.active {
    color: white;
    font-weight: 500;
}

.bg-active {
    background-color: var(--main-bseu-color) !important;
}

/* Контейнер контента с анимацией */
.accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.accordion-content.expanded {
    max-height: 500px;
}
</style>
