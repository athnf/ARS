<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Event Listener Mapping
     * Semua event yang ingin kita dengarkan secara manual.
     */
    protected $listen = [
        // Event ketika user baru register
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // Event ketika user berhasil login
        Login::class => [
            LogSuccessfulLogin::class,
        ],
    ];

    /**
     * Boot the event services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Auto Discovery Listener (false = manual)
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
