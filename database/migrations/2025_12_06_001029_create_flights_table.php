<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();

            // 1. Informasi Dasar Penerbangan
            $table->string('flight_number')->unique();
            $table->string('airline');
            $table->string('aircraft_type');
            
            // 2. Rute
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->string('departure_airport_code', 3); // IATA code, e.g., CGK
            $table->string('arrival_airport_code', 3);   // IATA code, e.g., DPS
            
            // 3. Jadwal dan Kapasitas
            $table->dateTime('scheduled_departure'); // Tanggal dan Waktu Keberangkatan
            $table->dateTime('scheduled_arrival');   // Tanggal dan Waktu Kedatangan
            $table->unsignedSmallInteger('capacity'); // Jumlah kursi total
            
            // 4. Harga Default (untuk display di Homepage)
            $table->decimal('base_price', 10, 2); // Harga dasar tiket
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
