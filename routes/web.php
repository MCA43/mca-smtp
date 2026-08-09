<?php

use Illuminate\Support\Facades\Route;

$web = config('smtp.routes.web', []);
$prefix = $web['prefix'] ?? 'mca/smtp';
$middleware = $web['middleware'] ?? ['web', 'auth', 'mca.smtp.root', 'mca.smtp.locale'];
$namePrefix = config('smtp.routes.web.name_prefix', 'mca.smtp.');
$controllers = config('smtp.controllers.web', []);
$smtp = $controllers['smtp'] ?? \Mca\Smtp\Http\Controllers\Web\SmtpController::class;

Route::prefix($prefix)
    ->middleware($middleware)
    ->name($namePrefix)
    ->group(function () use ($smtp) {
        Route::get('/', [$smtp, 'index'])->name('index');
        Route::put('/', [$smtp, 'update'])->name('update');
        Route::post('/test', [$smtp, 'sendTest'])->name('test');
    });
