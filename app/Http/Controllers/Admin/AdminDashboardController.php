<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 1. Total Penerbangan (Aktif)
        $totalFlights = Flight::count();

        // 2. Total Pemesanan (Hanya yang berstatus 'Booked')
        $totalBookings = Ticket::where('status', 'Booked')->count();

        // 3. Tiket Dibatalkan (Soft Delete)
        // Menggunakan onlyTrashed() untuk menghitung data yang di-soft delete
        $totalCancelled = Ticket::onlyTrashed()->count(); 

        return view('admin.dashboard', compact('totalFlights', 'totalBookings', 'totalCancelled'));
    }
}