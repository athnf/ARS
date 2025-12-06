<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LogSuccessfulLogin
{
    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        AuditLog::create([
            'user_id' => $event->user->id,
            'action' => 'LOGIN',
            'table_name' => 'users', // Login memengaruhi tabel users
            'record_id' => $event->user->id,
            'description' => "Pengguna {$event->user->name} ({$event->user->role}) berhasil login.",
        ]);
    }
}