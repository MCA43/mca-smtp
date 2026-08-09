<?php

namespace Mca\Smtp\Models;

use Illuminate\Database\Eloquent\Model;

class SmtpSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'is_secret',
    ];

    protected function casts(): array
    {
        return [
            'is_secret' => 'boolean',
        ];
    }

    public function getTable(): string
    {
        return (string) config('smtp.table', 'mca_smtp_settings');
    }
}
