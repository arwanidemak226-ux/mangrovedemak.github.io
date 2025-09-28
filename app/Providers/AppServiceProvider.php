<?php

namespace App\Providers;

use App\Models\PendataanTanaman;
use App\Observers\PendataanTanamanObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        PendataanTanaman::observe(PendataanTanamanObserver::class);
    }
}
