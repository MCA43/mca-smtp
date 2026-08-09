<?php

namespace Mca\Smtp\Support;

use Illuminate\Contracts\View\View;

final class McaSmtpView
{
    public static function layout(): string
    {
        return (string) config('smtp.views.layout', 'mca-smtp::layouts.app');
    }

    public static function render(string $view, array $data = []): View
    {
        McaSmtpLocale::apply();

        $namespace = config('smtp.views.namespace', 'mca-smtp');

        return view($namespace.'::'.$view, array_merge([
            'mcaSmtpTitle' => config('smtp.ui.title') ?: mca_smtp_t('app.title'),
        ], $data));
    }

    public static function uiCssUrl(): string
    {
        return asset((string) config('smtp.ui.assets.ui', 'vendor/mca-permission/mca-ui.css'));
    }

    public static function uiJsUrl(): string
    {
        return asset((string) config('smtp.ui.assets.ui_js', 'vendor/mca-permission/mca-ui.js'));
    }

    public static function cssUrl(): string
    {
        return asset((string) config('smtp.ui.assets.css', 'vendor/mca-smtp/mca-smtp.css'));
    }

    public static function jsUrl(): string
    {
        return asset((string) config('smtp.ui.assets.js', 'vendor/mca-smtp/mca-smtp.js'));
    }
}
