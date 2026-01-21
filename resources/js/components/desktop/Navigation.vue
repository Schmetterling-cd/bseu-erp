<template>
    <li class="nav-item" v-for="navElement in navElements" :key="navElement.uuid">
        <NavGroup v-if="isGroupElement(navElement)" :group="navElement" @item-click="handleItemClick"
            @toggle="handleGroupToggle(navElement.uuid)" />
        <NavLink v-else :link="navElement" @click="handleItemClick(navElement)" />
    </li>
</template>

<script setup>
import { reactive, watch } from 'vue';
import NavGroup from './NavGroup.vue';
import NavLink from './NavLink.vue';
import { useRouter, useRoute } from 'vue-router';

const router = useRouter();
const route = useRoute();

watch(() => router.currentRoute.value, () => {
    const currentComponent = router.currentRoute.value;
    const id = getElementIdByPath(currentComponent.matched[currentComponent.matched.length - 1].path, navElements);

    setActiveItemById(id);
    disableNotActiveItems(navElements, id);
});

const navElements = reactive([
    {
        uuid: 5,
        title: 'Главная',
        icon: 'bi-house-door',
        active: false,
        link: '/'
    },
    {
        uuid: 1,
        title: 'Текущая аттестация',
        icon: 'bi-journal-text',
        active: false,
        link: '/current-attestation/index',
        isGroup: false,
        items: [
            {
                uuid: 3,
                title: 'Аттестация',
                icon: 'bi-table',
                active: false,
                link: '/current-attestation/content'
            },
            {
                uuid: 4,
                title: 'Журнал группы',
                icon: 'bi-table',
                active: false,
                link: '/current-attestation/card/:id'
            }
        ]
    },
]);

const getElementIdByPath = (path, elements) => {
    for (const element of elements) {
        switch (true) {
            case isGroupElement(element) || (hasSubItems(element) && element.link !== path):
                return getElementIdByPath(path, element.items);
            case element.link === path:
                return element.uuid;
        }
    }

    return null;
};

const isGroupElement = (element) => {
    return element.isGroup && element.items && Array.isArray(element.items) && element.items.length > 0;
};

const hasSubItems = (element) => {
    return element.items && Array.isArray(element.items) && element.items.length > 0;
};

const findGroupByItemId = (itemId) => {
    return navElements.find((element) => {
        return (isGroupElement(element) || hasSubItems(element)) && element.items.some(item => item.uuid === itemId);
    });
};

const setActiveItemById = (itemId) => {
    const group = findGroupByItemId(itemId);

    if (group) {
        group.active = true;
        group.items.find(item => item.uuid === itemId).active = true;
    } else {
        navElements.find(item => item.uuid === itemId).active = true;
    }
};

const disableNotActiveItems = (elements, activeItemId) => {
    elements.forEach((element) => {
        if (element.uuid !== activeItemId) {
            switch (true) {
                case isGroupElement(element):
                    console.log(element, 'group');
                    disableNotActiveItems(element.items, activeItemId);
                    break;
                case hasSubItems(element):
                    disableNotActiveItems(element.items, activeItemId);

                    if (!hasActiveItem(element)) {
                        element.active = false;
                    }
                    break;
                case !isGroupElement(element) && !hasSubItems(element):
                    disableNotActiveItem(element);
                    break;
            }
        }
    });
}

const disableNotActiveGroups = (elements) => {
    elements.forEach((element) => {
        if (isGroupElement(element) && !hasActiveItem(element)) {
            element.active = false;
        }
    });
}

const disableNotActiveItem = (element) => {
    element.active = false;
}

const handleItemClick = (item) => {
    try {
        setActiveItemById(item.uuid);
        disableNotActiveItems(navElements, item.uuid);
        disableNotActiveGroups(navElements);
    } finally {
        router.push(item.link);
    }
};

const hasActiveItem = (element) => {
    return element.items.some(item => item.active);
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
.nav-item {
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.nav-item:last-child {
    border-bottom: none;
}
</style>
