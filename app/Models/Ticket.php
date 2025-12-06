<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Import SoftDeletes

class Ticket extends Model
{
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes

    // Kolom-kolom yang aman untuk diisi melalui mass assignment
    protected $fillable = [
        'user_id',
        'flight_id',
        'seat_number',
        'price_paid',
        'status',
    ];

    // Relasi 1: Relasi ke User (Siapa yang memesan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi 2: Relasi ke Flight (Penerbangan mana yang dipesan)
    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }
}