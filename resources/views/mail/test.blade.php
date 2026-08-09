<x-mail::message>
# {{ mca_smtp_t('mail.test_subject') }}

{{ mca_smtp_t('mail.test_body') }}

{{ config('app.name') }} · {{ now()->toDateTimeString() }}
</x-mail::message>
