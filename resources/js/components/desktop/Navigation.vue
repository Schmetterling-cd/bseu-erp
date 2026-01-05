<template>
    <li class="nav-item" v-for="navElement in navElements" :key="navElement.uuid">
        <NavGroup v-if="isGroupElement(navElement)" :group="navElement" @item-click="handleItemClick"
            @toggle="handleGroupToggle(navElement.uuid)" />
        <NavLink v-else :link="navElement" @click="handleItemClick(navElement)" />
    </li>
</template>

<script setup>
import { reactive } from 'vue';
import NavGroup from './NavGroup.vue';
import NavLink from './NavLink.vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const navElements = reactive([
    {
        uuid: 5,
        title: 'Главная',
        icon: 'bi-house-door',
        active: true,
        link: '/'
    },
    {
        uuid: 1,
        title: 'Текущая аттестация',
        icon: 'bi-journal-text',
        active: false,
        items: [
            {
                uuid: 2,
                title: 'Журнал аттестации',
                icon: 'bi-table',
                active: false,
                link: '/current-attestation/index'
            },
            {
                uuid: 3,
                title: 'Аттестация',
                icon: 'bi-table',
                active: false,
                link: '/current-attestation/content'
            }
        ]
    },
]);

const isGroupElement = (element) => {
    return element.items && Array.isArray(element.items) && element.items.length > 0;
};

const findGroupByItemId = (itemId) => {
    return navElements.find((element) => {
        return isGroupElement(element) && element.items.some(item => item.uuid === itemId);
    });
};

const setActiveItem = (itemId) => {
    const group = findGroupByItemId(itemId);

    if (group) {
        group.items.find(item => item.uuid === itemId).active = true;
    } else {
        navElements.find(item => item.uuid === itemId).active = true;
    }
};

const disableNotActiveItems = (elements, activeItemId) => {
    elements.forEach((element) => {
        if (element.uuid !== activeItemId) {
            if (isGroupElement(element)) {
                disableNotActiveItems(element.items, activeItemId);
            } else {
                disableNotActiveItem(element);
            }
        }
    });
}

const disableNotActiveItem = (element) => {
    element.active = false;
}

const handleItemClick = (item) => {
    try {
        setActiveItem(item.uuid);
        disableNotActiveItems(navElements, item.uuid);

        const group = findGroupByItemId(item.uuid);

        navElements.forEach((element) => {
            if (isGroupElement(element)) {
                switch (true) {
                    case group && element.uuid !== group.uuid:
                        element.active = false;
                        break;
                    case group && element.uuid === group.uuid:
                        element.active = true;
                        break;
                    case !group:
                        element.active = false;
                        break;
                }
            }
        });
    } finally {
        router.push(item.link);
    }

};

const hasActiveItem = (element) => {
    return element.items.some(item => item.active)
};

const handleGroupToggle = (groupId) => {
    const group = navElements.find(g => g.uuid === groupId);

    if (!group) return;

    if (hasActiveItem(group) && group.active) {
        return;
    }

    navElements.forEach(g => {
        if (isGroupElement(g) && !hasActiveItem(g) && g.uuid !== groupId) {
            g.active = false;
        }
    });

    group.active = !group.active;
};
</script>

<style scoped>
.custom-scrollbar {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.2) rgba(0, 0, 0, 0.1);
}

.custom-scrollbar::-webkit-scrollbar {
    width: 3px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    margin: 3px 0;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 2px;
    transition: background 0.2s ease;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.4);
}

.nav-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.nav-item:last-child {
    border-bottom: none;
}
</style>
