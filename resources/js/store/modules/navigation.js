import requester from "../../modules/requester";

export default {
    namespaced: true,

    state: {
        activeItemId: 5,
        navigation: [
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
        ],
    },

    getters: {
        getNavigation(state) {
            return state.navigation;
        },
    },

    mutations: {
        setNavigation(state, navigation) {
            state.navigation = navigation;
        },
        setActiveItem(state, activeItemId) {
            state.activeItemId = activeItemId;
        }
    },

    actions: {
        setUpNavigation({ state, commit }) {
            requester.sendPost('')
                .then(data => {
                    commit('setNavigation', data);
                })
        },
    }
}
