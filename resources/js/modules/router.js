import { createRouter, createWebHistory } from 'vue-router';
import loader from './loader';
import {routes} from './routes.js';
import {authGuard} from "./guards/authGuard.js";
import {GuardQueue} from "./guardQueue.js";

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.path !== from.path) {
        loader.showLoader(to.name);
    }

    const authGuardQueue = new GuardQueue();
    authGuardQueue.register(authGuard);
    const guardCheckResult = authGuardQueue.execute({ to });

    if (guardCheckResult) {
        next(guardCheckResult);
    } else {
        next();
    }
});

router.afterEach((to, from) => {
    loader.hideLoader(to.name);
});

export default router;
