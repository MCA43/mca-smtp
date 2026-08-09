<?php

namespace Mca\Smtp\Console;

use Illuminate\Console\Command;
use Mca\Smtp\Services\SmtpSettingsService;
use Mca\Smtp\Support\McaSmtpLocale;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'mca:smtp:test')]
class TestMailCommand extends Command
{
    protected $signature = 'mca:smtp:test {email : Recipient email address}';

    protected $description = 'Send a test email via MCA SMTP settings';

    public function handle(SmtpSettingsService $smtp): int
    {
        McaSmtpLocale::apply();

        $email = (string) $this->argument('email');

        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->components->error(mca_smtp_t('errors.invalid_email'));

            return self::FAILURE;
        }

        if (! $smtp->isConfigured()) {
            $this->components->error(mca_smtp_t('errors.not_configured'));

            return self::FAILURE;
        }

        try {
            $smtp->sendTest($email);
        } catch (\Throwable $e) {
            $this->components->error(mca_smtp_t('errors.send_failed', ['message' => $e->getMessage()]));

            return self::FAILURE;
        }

        $this->components->info(mca_smtp_t('flash.test_sent', ['email' => $email]));

        return self::SUCCESS;
    }
}
