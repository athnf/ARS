<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan Halaman Utama (Homepage)
     */
    public function index()
    {
        // Ambil 6 jadwal penerbangan terdekat yang belum berlalu
        $flights = Flight::where('scheduled_departure', '>', now())
                        ->orderBy('scheduled_departure')
                        ->limit(6)
                        ->get();
                        
        // Tampilkan view homepage
        return view('welcome', compact('flights'));
    }
}