<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function __construct()
    {
        // Pastikan hanya user yang terautentikasi bisa mengakses fungsi di controller ini
        $this->middleware('auth'); 
    }

    /**
     * Tampilkan semua jadwal penerbangan yang tersedia (User/user/flights).
     */
    public function index()
    {
        $flights = Flight::where('scheduled_departure', '>', now())
                        ->orderBy('scheduled_departure')
                        ->paginate(15);

        return view('user.flights.index', compact('flights'));
    }

    /**
     * Tampilkan form pemesanan untuk flight tertentu.
     */
    public function create(Flight $flight)
    {
        return view('user.flights.create', compact('flight'));
    }

    /**
     * Simpan pemesanan tiket ke database (Pesan Tiket).
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'seat_number' => 'required|string|max:5|unique:tickets,seat_number', 
            // Validasi sederhana, idealnya perlu validasi ketersediaan kursi
        ]);

        $flight = Flight::findOrFail($validated['flight_id']);
        
        // Memastikan proses booking atomic (jika ada error, semua dibatalkan)
        try {
            DB::beginTransaction();

            // 1. Buat Tiket
            Ticket::create([
                'user_id' => auth()->id(),
                'flight_id' => $flight->id,
                'seat_number' => $validated['seat_number'],
                'price_paid' => $flight->base_price, // Menggunakan harga dasar
                'status' => 'Booked',
            ]);

            DB::commit();

            return redirect()->route('user.tickets.index')
                             ->with('success', 'Pemesanan tiket berhasil! Silakan cek daftar tiket Anda.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pemesanan. ' . $e->getMessage());
        }
    }
}