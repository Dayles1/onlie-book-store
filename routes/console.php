<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Schedule::command('app:clean-unverified-users')
    ->daily()
    ->when(function () {
        return now()->dayOfYear % 3 === 0;
    });
Schedule::command('currency:sync')->daily();