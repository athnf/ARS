<?php

// database/migrations/YYYY_MM_DD_HHMMSS_create_audit_logs_table.php

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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();

            // 1. Siapa yang melakukan aksi
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null'); 
            // Nullable karena user mungkin logout saat sistem mencatat aksi
            
            // 2. Aksi apa (e.g., CREATE, UPDATE, DELETE, LOGIN)
            $table->string('action'); 
            
            // 3. Tabel mana yang diubah (e.g., 'flights', 'tickets')
            $table->string('table_name');
            
            // 4. ID mana dari tabel yang diubah
            $table->unsignedBigInteger('record_id')->nullable(); 

            // 5. Deskripsi detail perubahan (Opsional, tapi bagus untuk kelengkapan)
            $table->text('description')->nullable(); 
            
            $table->timestamps(); // Waktu aksi dilakukan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};