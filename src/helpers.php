<?php

use Mca\Smtp\Services\SmtpSettingsService;

if (! function_exists('mca_smtp')) {
    function mca_smtp(): SmtpSettingsService
    {
        return app(SmtpSettingsService::class);
    }
}

if (! function_exists('mca_smtp_t')) {
    /** @param  array<string, string|int>  $replace */
    function mca_smtp_t(string $key, array $replace = []): string
    {
        return (string) __('mca-smtp::smtp.'.$key, $replace);
    }
}
