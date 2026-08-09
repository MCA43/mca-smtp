<?php

namespace Mca\Smtp\Services;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Mca\Smtp\Mail\TestMailMessage;

class SmtpSettingsService
{
    public function __construct(
        protected SmtpSettingsStore $store,
    ) {}

    public function apply(): void
    {
        if (! $this->mailerEnabled()) {
            return;
        }

        $host = $this->val('host');
        if ($host === '') {
            return;
        }

        $encryption = $this->val('encryption');
        $fromAddress = $this->val('from_address') ?: (string) config('mail.from.address');
        $fromName = $this->val('from_name') ?: (string) config('mail.from.name');
        $mailer = $this->val('mailer', 'smtp') ?: 'smtp';

        Config::set([
            'mail.default' => $mailer,
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.host' => $host,
            'mail.mailers.smtp.port' => (int) $this->val('port', '587'),
            'mail.mailers.smtp.encryption' => $encryption !== '' ? $encryption : null,
            'mail.mailers.smtp.username' => $this->val('username') !== '' ? $this->val('username') : null,
            'mail.mailers.smtp.password' => $this->passwordPlain(),
            'mail.from.address' => $fromAddress,
            'mail.from.name' => $fromName,
        ]);
    }

    public function mailerEnabled(): bool
    {
        $v = $this->store->get('mailer_enabled');
        if ($v === null) {
            return (bool) config('smtp.defaults.mailer_enabled', false);
        }

        return in_array(strtolower((string) $v), ['1', 'true', 'yes', 'on'], true);
    }

    public function isConfigured(): bool
    {
        return $this->mailerEnabled() && $this->val('host') !== '';
    }

    public function hasPassword(): bool
    {
        return $this->passwordPlain() !== null && $this->passwordPlain() !== '';
    }

    public function passwordPlain(): ?string
    {
        $pwd = $this->store->get('password');
        if ($pwd === null || $pwd === '') {
            $fallback = (string) config('smtp.defaults.password', '');

            return $fallback !== '' ? $fallback : null;
        }

        return $pwd;
    }

    /** @param  string|list<string>  $to */
    public function send(Mailable $mailable, string|array $to): void
    {
        $this->apply();
        Mail::to($to)->send($mailable);
    }

    public function sendTest(string $to): void
    {
        $this->send(new TestMailMessage, $to);
    }

    /** Settings for admin form. */
    public function settingsForAdmin(): array
    {
        return [
            'mailer_enabled' => $this->mailerEnabled(),
            'mailer' => $this->val('mailer', (string) config('smtp.defaults.mailer', 'smtp')),
            'host' => $this->val('host'),
            'port' => $this->val('port', (string) config('smtp.defaults.port', '587')),
            'encryption' => $this->val('encryption', (string) config('smtp.defaults.encryption', 'tls')),
            'username' => $this->val('username'),
            'password_set' => $this->hasPassword(),
            'from_name' => $this->val('from_name'),
            'from_address' => $this->val('from_address'),
            'default_recipient' => $this->val('default_recipient'),
        ];
    }

    public function forgetResolved(): void
    {
        $this->store->forgetCache();
    }

    protected function val(string $key, string $fallback = ''): string
    {
        $v = $this->store->get($key);
        if (is_string($v) && $v !== '') {
            return $v;
        }

        $cfg = config('smtp.defaults.'.$key);
        if ($cfg !== null && $cfg !== '') {
            return (string) $cfg;
        }

        return $fallback;
    }
}
