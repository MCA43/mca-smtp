<?php

namespace Mca\Smtp;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Mca\Smtp\Console\InstallSmtpCommand;
use Mca\Smtp\Console\TestMailCommand;
use Mca\Smtp\Http\Middleware\EnsureMcaSmtpRoot;
use Mca\Smtp\Http\Middleware\SetMcaSmtpLocale;
use Mca\Smtp\Services\SmtpSettingsService;
use Mca\Smtp\Services\SmtpSettingsStore;

class SmtpServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/smtp.php', 'smtp');
        $this->app->singleton(SmtpSettingsStore::class);
        $this->app->singleton(SmtpSettingsService::class);
    }

    public function boot(): void
    {
        if (! config('smtp.enabled', true)) {
            return;
        }

        $this->registerPublishing();
        $this->registerMiddleware();
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'mca-smtp');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'mca-smtp');
        $this->registerRoutes();
        $this->registerHub();
        $this->autoApply();

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallSmtpCommand::class,
                TestMailCommand::class,
            ]);
        }
    }

    protected function autoApply(): void
    {
        if (! config('smtp.auto_apply', true)) {
            return;
        }

        $this->app->booted(function (): void {
            try {
                app(SmtpSettingsService::class)->apply();
            } catch (\Throwable) {
                // table may not exist yet
            }
        });
    }

    protected function registerHub(): void
    {
        if (! function_exists('mca_hub_register')) {
            return;
        }

        mca_hub_register('smtp', [
            'enabled' => fn () => (bool) config('smtp.enabled', true),
        ]);
    }

    protected function registerPublishing(): void
    {
        $this->publishes([
            __DIR__.'/../config/smtp.php' => config_path('smtp.php'),
        ], 'mca-smtp-config');

        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/mca-smtp'),
        ], 'mca-smtp-assets');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/mca-smtp'),
        ], 'mca-smtp-views');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'mca-smtp-migrations');
    }

    protected function registerMiddleware(): void
    {
        /** @var Router $router */
        $router = $this->app['router'];
        $router->aliasMiddleware('mca.smtp.root', EnsureMcaSmtpRoot::class);
        $router->aliasMiddleware('mca.smtp.locale', SetMcaSmtpLocale::class);
    }

    protected function registerRoutes(): void
    {
        if (! config('smtp.routes.load_package_routes', true)) {
            return;
        }

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
