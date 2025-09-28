<?php

namespace App\Observers;

use Illuminate\Support\Facades\Artisan;
use App\Models\PendataanTanaman;

class PendataanTanamanObserver
{
    /**
     * Handle the PendataanTanaman "created" event.
     */
    public function created(PendataanTanaman $pendataanTanaman): void
    {
        
        Artisan::call('app:calculate-monthly-summary');
    }

    /**
     * Handle the PendataanTanaman "updated" event.
     */
    public function updated(PendataanTanaman $pendataanTanaman): void
    {
        Artisan::call('app:calculate-monthly-summary');
    }

    /**
     * Handle the PendataanTanaman "deleted" event.
     */
    public function deleted(PendataanTanaman $pendataanTanaman): void
    {
        Artisan::call('app:calculate-monthly-summary');
    }

    /**
     * Handle the PendataanTanaman "restored" event.
     */
    public function restored(PendataanTanaman $pendataanTanaman): void
    {
        //
    }

    /**
     * Handle the PendataanTanaman "force deleted" event.
     */
    public function forceDeleted(PendataanTanaman $pendataanTanaman): void
    {
        //
    }
}
