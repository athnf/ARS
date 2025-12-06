<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada berdasarkan email, agar tidak duplikasi
        $adminEmail = 'admin@ars.com'; 
        
        if (DB::table('users')->where('email', $adminEmail)->doesntExist()) {
             DB::table('users')->insert([
                'name' => 'Super Admin ARS',
                'email' => $adminEmail,
                'password' => Hash::make('password'), // Password default: 'password'
                'role' => 'admin', // KRUSIAL: Set role sebagai admin
                'phone' => '081234567890', // Nomor telepon (akan otomatis terenkripsi)
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
