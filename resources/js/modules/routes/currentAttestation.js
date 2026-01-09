export default [
    {
        path: '/current-attestation/index',
        name: 'currentAttestationIndex',
        component: () => import('../../pages/currentAttestation/CurrentAttestationIndex.vue'),
    },
    {
        path: '/current-attestation/content',
        name: 'currentAttestationContent',
        component: () => import('../../pages/currentAttestation/CurrentAttestationContent.vue'),
    }
];
