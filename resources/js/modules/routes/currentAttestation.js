export default [
    {
        path: '/current-attestation/index',
        name: 'currentAttestationIndex',
        component: () => import('../../pages/currentAttestation/currentAttestationIndex.vue'),
    },
    {
        path: '/current-attestation/content',
        name: 'currentAttestationContent',
        component: () => import('../../pages/currentAttestation/currentAttestationContent.vue'),
    }
];
