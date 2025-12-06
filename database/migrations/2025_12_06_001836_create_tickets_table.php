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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // 1. FOREIGN KEY ke USERS (Poin Dosen: Dua Foreign Key)
            // Relasi antara siapa yang memesan tiket
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade'); // Jika user dihapus, tiketnya ikut dihapus (Hard Delete)

            // 2. FOREIGN KEY ke FLIGHTS (Poin Dosen: Dua Foreign Key)
            // Relasi ke penerbangan mana tiket ini dipesan
            $table->foreignId('flight_id')
                  ->constrained('flights')
                  ->onDelete('cascade'); // Jika flight dihapus, tiketnya ikut dihapus (Hard Delete)

            // 3. Detail Tiket
            $table->string('seat_number', 5);
            $table->decimal('price_paid', 10, 2); // Harga yang dibayarkan saat pemesanan

            // 4. Status Pemesanan
            $table->enum('status', ['Booked', 'Canceled', 'Checked-in'])->default('Booked');
            
            // 5. Soft Deletes (Poin Dosen: Soft Delete & Recovery)
            $table->softDeletes(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};