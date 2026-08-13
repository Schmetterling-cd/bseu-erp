<?php

namespace UI\Enums;

enum PagesEnum: string
{
    case Dashboard = 'dashboard';
    case MiddleAttestation = 'middle-attestation';

    public static function getPageUrls(): array
    {
        return [
            PagesEnum::Dashboard->value => '/dashboard',
            PagesEnum::MiddleAttestation->value => '/attestation/middle-attestation',
        ];
    }

    public static function getPageUrl(PagesEnum $page): string
    {
        return self::getPageUrls()[$page->value];
    }
}
