@php
    $np = config('smtp.routes.web.name_prefix', 'mca.smtp.');
@endphp
@extends(\Mca\Smtp\Support\McaSmtpView::layout())

@section('title', mca_smtp_t('pages.index_title'))

@section('content')
    <div class="mca-smtp-toolbar">
        <div>
            <h1 class="mca-perm-title">{{ mca_smtp_t('pages.index_title') }}</h1>
            <p class="mca-perm-help">{{ mca_smtp_t('pages.help') }}</p>
        </div>
    </div>

    <form method="post" action="{{ route($np.'update') }}" class="mca-perm-card mca-smtp-form">
        @csrf
        @method('PUT')

        <div class="mca-perm-card__body">
            <label class="mca-smtp-switch">
                <input type="checkbox" name="mailer_enabled" value="1" @checked(old('mailer_enabled', $settings['mailer_enabled']))>
                <span>{{ mca_smtp_t('fields.mailer_enabled') }}</span>
            </label>

            <div class="mca-smtp-grid">
                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.mailer') }}</span>
                    <select name="mailer" class="mca-perm-input">
                        @foreach (['smtp', 'log'] as $m)
                            <option value="{{ $m }}" @selected(old('mailer', $settings['mailer']) === $m)>{{ mca_smtp_t('mailers.'.$m) }}</option>
                        @endforeach
                    </select>
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.host') }}</span>
                    <input type="text" name="host" class="mca-perm-input" value="{{ old('host', $settings['host']) }}" autocomplete="off">
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.port') }}</span>
                    <input type="number" name="port" class="mca-perm-input" value="{{ old('port', $settings['port']) }}">
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.encryption') }}</span>
                    <select name="encryption" class="mca-perm-input">
                        <option value="" @selected(old('encryption', $settings['encryption']) === '')>{{ mca_smtp_t('encryption.none') }}</option>
                        <option value="tls" @selected(old('encryption', $settings['encryption']) === 'tls')>{{ mca_smtp_t('encryption.tls') }}</option>
                        <option value="ssl" @selected(old('encryption', $settings['encryption']) === 'ssl')>{{ mca_smtp_t('encryption.ssl') }}</option>
                    </select>
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.username') }}</span>
                    <input type="text" name="username" class="mca-perm-input" value="{{ old('username', $settings['username']) }}" autocomplete="off">
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.password') }}</span>
                    <input type="password" name="password" class="mca-perm-input" autocomplete="new-password"
                           placeholder="{{ ($settings['password_set'] ?? false) ? '••••••••' : '' }}" value="">
                    <span class="mca-perm-help">{{ mca_smtp_t('fields.password_keep') }}</span>
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.from_name') }}</span>
                    <input type="text" name="from_name" class="mca-perm-input" value="{{ old('from_name', $settings['from_name']) }}">
                </label>

                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.from_address') }}</span>
                    <input type="email" name="from_address" class="mca-perm-input" value="{{ old('from_address', $settings['from_address']) }}">
                </label>

                <label class="mca-perm-field mca-smtp-grid__full">
                    <span>{{ mca_smtp_t('fields.default_recipient') }}</span>
                    <input type="email" name="default_recipient" class="mca-perm-input" value="{{ old('default_recipient', $settings['default_recipient']) }}">
                </label>
            </div>
        </div>

        <div class="mca-perm-card__footer">
            <button type="submit" class="mca-ui-btn mca-ui-btn--primary">{{ mca_smtp_t('actions.save') }}</button>
        </div>
    </form>

    <div class="mca-perm-card mca-smtp-test">
        <div class="mca-perm-card__body">
            <h2 class="mca-smtp-subtitle">{{ mca_smtp_t('pages.test_title') }}</h2>
            <p class="mca-perm-help">{{ mca_smtp_t('pages.test_help') }}</p>

            <form method="post" action="{{ route($np.'test') }}" class="mca-smtp-test-form">
                @csrf
                <label class="mca-perm-field">
                    <span>{{ mca_smtp_t('fields.test_email') }}</span>
                    <input type="email" name="email" class="mca-perm-input" required
                           value="{{ old('email', $settings['default_recipient']) }}">
                </label>
                <button type="submit" class="mca-ui-btn">{{ mca_smtp_t('actions.send_test') }}</button>
            </form>
        </div>
    </div>
@endsection
