<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Flight;
use App\Models\Ticket;
use App\Observers\AuditObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * Tempat untuk bind service custom atau register library
     * (biasanya jarang dipakai kecuali project besar)
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * Semua hal yang harus jalan ketika aplikasi booting.
     * Di sini kita daftarkan observer untuk Audit Log.
     */
    public function boot(): void
    {
        // AuditObserver akan menangkap event created, updated, deleted
        // lalu mencatatnya ke tabel audit_logs (nanti kita buat).
        Flight::observe(AuditObserver::class);
        Ticket::observe(AuditObserver::class);
    }
}
