import { createRouter, createWebHistory } from 'vue-router';
import loader from './loader';
import currentAttestationRoutes from './routes/currentAttestation';

let routes = [
    {
        path: '/',
        name: ' Dashboard',
        component: () => import('../pages/Dashboard.vue'),
    }
];

routes = routes.concat(
    currentAttestationRoutes
);

console.log(routes);

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    if (to.path !== from.path) {
        loader.showLoader(to.name);
    }
    next();
});

router.afterEach((to, from) => {
    loader.hideLoader(to.name);
});

export default router;
