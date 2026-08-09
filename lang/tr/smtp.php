<?php

return [
    'app' => [
        'title' => 'E-posta / SMTP',
        'brand' => 'SMTP',
        'nav_aria' => 'SMTP menüsü',
    ],
    'nav' => [
        'back_mca' => 'MCA Hub',
        'settings' => 'Ayarlar',
    ],
    'pages' => [
        'index_title' => 'SMTP ayarları',
        'help' => 'Laravel’in kullanacağı mailer’ı yapılandırın. Etkinleştirildiğinde ayarlar çalışma anında uygulanır.',
        'test_title' => 'Test e-postası gönder',
        'test_help' => 'Yukarıda kayıtlı SMTP ayarlarını kullanır.',
    ],
    'fields' => [
        'mailer_enabled' => 'Panel SMTP’yi etkinleştir',
        'mailer' => 'Mailer',
        'host' => 'Sunucu',
        'port' => 'Port',
        'encryption' => 'Şifreleme',
        'username' => 'Kullanıcı adı',
        'password' => 'Şifre',
        'password_keep' => 'Mevcut şifreyi korumak için boş bırakın.',
        'from_name' => 'Gönderen adı',
        'from_address' => 'Gönderen adresi',
        'default_recipient' => 'Varsayılan alıcı',
        'test_email' => 'Alıcı',
    ],
    'mailers' => [
        'smtp' => 'SMTP',
        'log' => 'Log (geliştirme)',
    ],
    'encryption' => [
        'none' => 'Yok',
        'tls' => 'TLS',
        'ssl' => 'SSL',
    ],
    'actions' => [
        'save' => 'Ayarları kaydet',
        'send_test' => 'Test gönder',
    ],
    'flash' => [
        'updated' => 'SMTP ayarları kaydedildi.',
        'test_sent' => 'Test e-postası :email adresine gönderildi.',
    ],
    'errors' => [
        'root_only' => 'SMTP yönetmek yalnızca root kullanıcılar içindir.',
        'not_configured' => 'SMTP etkin değil veya sunucu boş.',
        'invalid_email' => 'Geçerli bir e-posta adresi girin.',
        'send_failed' => 'Gönderilemedi: :message',
    ],
    'mail' => [
        'test_subject' => 'MCA SMTP test mesajı',
        'test_body' => 'Bu mesajı aldıysanız SMTP çalışıyor demektir.',
    ],
    'modal' => [
        'ok' => 'Tamam',
        'confirm' => 'Onayla',
        'cancel' => 'İptal',
        'close' => 'Kapat',
        'alert_title' => 'Bildirim',
        'confirm_title' => 'Onay',
    ],
    'console' => [
        'install' => [
            'start' => 'MCA SMTP kuruluyor…',
            'config_ready' => 'Config yayınlandı / hazır',
            'assets_published' => 'Asset’ler yayınlandı',
            'migration_done' => 'Migrasyonlar çalıştırıldı',
            'done' => 'MCA SMTP kuruldu.',
            'web_ui' => 'Yönetim arayüzü: /:prefix',
        ],
    ],
];
