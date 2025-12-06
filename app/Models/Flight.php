<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;
    
    // Kolom-kolom yang aman untuk diisi melalui mass assignment (Form Input)
    protected $fillable = [
        'flight_number',
        'airline',
        'aircraft_type',
        'departure_city',
        'arrival_city',
        'departure_airport_code',
        'arrival_airport_code',
        'scheduled_departure',
        'scheduled_arrival',
        'capacity',
        'base_price',
    ];
    
    // Konversi kolom waktu ke objek Carbon secara otomatis (Opsional, tapi direkomendasikan)
    protected $casts = [
        'scheduled_departure' => 'datetime',
        'scheduled_arrival' => 'datetime',
        'base_price' => 'decimal:2',
    ];

    // Relasi akan ditambahkan nanti (Relasi ke Tickets)
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}