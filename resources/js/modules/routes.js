import authentication from "./routes/authentication.js";
import currentAttestationRoutes from './routes/currentAttestation';

const publicRoutes = () => {
    try {
        const routes = import.meta.env.VITE_AUTH_ROUTES;
        return routes ? JSON.parse(routes) : [];
    } catch {
        return [];
    }
}

export const isPublicRoute = (route) => {
    return publicRoutes().some(publicRoute => publicRoute === route);
}

export const isAuthRoute = (route) => {
    const authRouts = JSON.parse(import.meta.env.VITE_AUTH_ROUTES ?? '');

    return authRouts.some(authRouts => authRouts === route);
}

export const routes = [
    {
        path: '/',
        name: ' Dashboard',
        component: () => import('../pages/Dashboard.vue'),
    },
    ...authentication,
    ...currentAttestationRoutes
];


