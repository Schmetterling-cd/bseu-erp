import store from "../../store/store.js";
import {isPublicRoute, isAuthRoute} from "../routes.js";

export const authGuard = ({to}) => {
    const isAuthenticated = store.state.user.isAuthenticated;
    const isHasRole = store.state.user.user.role;
    const isPublic = isPublicRoute(to.path);
    const isAuth = isAuthRoute(to.path);

    switch (true) {
        case isAuthenticated && isAuth:
            return {
                name: 'Dashboard'
            };
        case isAuthenticated && !isHasRole:
            return {
                name: 'ChooseRole',
            };
        case !isAuthenticated && !isPublic:
            return {
                name: 'Login',
                query: { redirect: to.fullPath }
            };
        default:
            return null;
    }
}
