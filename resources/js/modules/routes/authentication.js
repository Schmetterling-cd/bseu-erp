export default [
    {
        path: '/login',
        name: 'Login',
        component: () => import('../../pages/desktop/authentication/Login.vue'),
    },
    {
        path: '/register',
        name: 'Register',
        component: () => import('../../pages/desktop/authentication/Register.vue'),
    },
    {
        path: '/password-recovery',
        name: 'PasswordRecovery',
        component: () => import('../../pages/desktop/authentication/PasswordRecovery.vue'),
    },
    {
        path: '/password-change',
        name: 'PasswordReset',
        component: () => import('../../pages/desktop/authentication/PasswordChange.vue'),
    },
    {
        path: '/email-verification',
        name: 'EmailVerification',
        component: () => import('../../pages/desktop/authentication/EmailVerification.vue'),
    },
    {
        path: '/choose-role',
        name: 'ChooseRole',
        component: () => import('../../pages/desktop/authentication/ChooseRole.vue'),
    }
];
