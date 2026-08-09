<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', $mcaSmtpTitle ?? mca_smtp_t('app.title'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ \Mca\Smtp\Support\McaSmtpView::uiCssUrl() }}">
    <link rel="stylesheet" href="{{ \Mca\Smtp\Support\McaSmtpView::cssUrl() }}">
    @stack('mca-smtp-head')
</head>
<body class="mca-ui-root mca-perm-root mca-smtp-root">
    @include('mca-smtp::partials.header')

    <main class="mca-ui-main mca-perm-main mca-smtp-main">
        @include('mca-smtp::partials.flash')
        @yield('content')
    </main>

    @php
        $mcaUiI18n = [
            'ok' => mca_smtp_t('modal.ok'),
            'confirm' => mca_smtp_t('modal.confirm'),
            'cancel' => mca_smtp_t('modal.cancel'),
            'close' => mca_smtp_t('modal.close'),
            'alert_title' => mca_smtp_t('modal.alert_title'),
            'confirm_title' => mca_smtp_t('modal.confirm_title'),
        ];
    @endphp
    <script>
        window.McaUiI18n = @json($mcaUiI18n);
    </script>
    <script src="{{ \Mca\Smtp\Support\McaSmtpView::uiJsUrl() }}" defer></script>
    <script src="{{ \Mca\Smtp\Support\McaSmtpView::jsUrl() }}" defer></script>
    @stack('mca-smtp-scripts')
</body>
</html>
