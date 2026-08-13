import { createStore } from 'vuex'
import user from './modules/user'
import navigation from './modules/navigation'

export default createStore({
    modules: {
        user,
        navigation,
    }
})
