<?php

namespace Mca\Smtp\Http\Controllers\Web;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Mca\Smtp\Http\Requests\SendTestMailRequest;
use Mca\Smtp\Http\Requests\UpdateSmtpSettingsRequest;
use Mca\Smtp\Services\SmtpSettingsService;
use Mca\Smtp\Services\SmtpSettingsStore;
use Mca\Smtp\Support\McaSmtpView;

class SmtpController extends Controller
{
    public function index(SmtpSettingsService $smtp): View
    {
        return McaSmtpView::render('settings.index', [
            'settings' => $smtp->settingsForAdmin(),
        ]);
    }

    public function update(
        UpdateSmtpSettingsRequest $request,
        SmtpSettingsStore $store,
        SmtpSettingsService $smtp,
    ): RedirectResponse {
        $data = $request->validated();

        $pairs = [
            'mailer_enabled' => ['value' => ! empty($data['mailer_enabled']) ? '1' : '0', 'secret' => false],
            'mailer' => ['value' => $data['mailer'] ?? 'smtp', 'secret' => false],
            'host' => ['value' => $data['host'] ?? '', 'secret' => false],
            'port' => ['value' => (string) ($data['port'] ?? '587'), 'secret' => false],
            'encryption' => ['value' => $data['encryption'] ?? '', 'secret' => false],
            'username' => ['value' => $data['username'] ?? '', 'secret' => false],
            'from_name' => ['value' => $data['from_name'] ?? '', 'secret' => false],
            'from_address' => ['value' => $data['from_address'] ?? '', 'secret' => false],
            'default_recipient' => ['value' => $data['default_recipient'] ?? '', 'secret' => false],
        ];

        $password = trim((string) ($data['password'] ?? ''));
        if ($password !== '' && $password !== '••••••••') {
            $pairs['password'] = ['value' => $password, 'secret' => true];
        }

        $store->putMany($pairs);
        $smtp->forgetResolved();
        $smtp->apply();

        return redirect()
            ->route(config('smtp.routes.web.name_prefix', 'mca.smtp.').'index')
            ->with('status', mca_smtp_t('flash.updated'));
    }

    public function sendTest(
        SendTestMailRequest $request,
        SmtpSettingsService $smtp,
    ): RedirectResponse {
        $email = $request->validated('email');

        try {
            $smtp->sendTest($email);
        } catch (\Throwable $e) {
            return back()
                ->withInput()
                ->withErrors(['email' => mca_smtp_t('errors.send_failed', ['message' => $e->getMessage()])]);
        }

        return back()->with('status', mca_smtp_t('flash.test_sent', ['email' => $email]));
    }
}
