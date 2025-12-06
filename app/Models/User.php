<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Model User
 * ---------------------------------------------------
 * Fitur yang sudah disiapin:
 * - RBAC basic: field role
 * - Enkripsi nomor telepon
 * - HasApiTokens buat API auth (Sanctum)
 * - Relasi ke Ticket (user punya banyak tiket)
 * - Casting password otomatis hashed
 * - Kompatibel Laravel Breeze 
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Mass Assignment
     * ---------------------------------------------------
     * Field yang boleh diisi lewat create() / update().
     * Tambahan:
     * - role: RBAC (admin, staff, user)
     * - phone: disimpan terenkripsi
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];

    /**
     * Hidden
     * ---------------------------------------------------
     * Field yang tidak ikut dikirim ketika data user
     * diserialisasi ke JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts
     * ---------------------------------------------------
     * - password: otomatis di-hash
     * - email_verified_at: carbon instance
     * - phone: dienkripsi oleh Laravel (AES-256)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'phone' => 'encrypted',
    ];

    /**
     * Relasi
     * ---------------------------------------------------
     * User punya banyak tiket.
     * Contoh akses:
     * $user->tickets;
     */
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Helper Role (opsional)
     * ---------------------------------------------------
     * Biar gampang check role user:
     * if ($user->isAdmin()) { ... }
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }
}
