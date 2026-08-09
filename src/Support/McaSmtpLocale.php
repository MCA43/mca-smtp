<?php

namespace Mca\Smtp\Support;

final class McaSmtpLocale
{
    public static function resolve(): string
    {
        $locale = config('smtp.locale');

        if (is_string($locale) && $locale !== '') {
            return $locale;
        }

        return (string) app()->getLocale();
    }

    public static function apply(): void
    {
        app()->setLocale(self::resolve());
    }
}
