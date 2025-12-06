<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class UserTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar tiket milik user yang sedang login (Poin Dosen: Lihat tiket miliknya).
     */
    public function index()
    {
        // Ambil SEMUA tiket (termasuk yang dibatalkan) milik user yang sedang login
        $tickets = Ticket::where('user_id', auth()->id())
                         ->withTrashed() // Termasuk yang dibatalkan
                         ->with('flight')
                         ->latest()
                         ->paginate(10);
                         
        return view('user.tickets.index', compact('tickets'));
    }

    /**
     * Batalkan/Soft Delete Tiket (Poin Dosen: Batalkan tiket & Soft Delete).
     */
    public function destroy(Ticket $ticket)
    {
        // PENTING: Pastikan hanya user yang memiliki tiket ini yang bisa membatalkan
        if ($ticket->user_id !== auth()->id()) {
            abort(403, 'Akses Ditolak. Tiket ini bukan milik Anda.');
        }

        // Cek status, tiket yang sudah dibatalkan tidak bisa dibatalkan lagi
        if ($ticket->trashed()) {
            return back()->with('error', 'Tiket ini sudah dibatalkan sebelumnya.');
        }

        // Soft Delete (Mencatat ke deleted_at)
        $ticket->delete(); 
        
        return redirect()->route('user.tickets.index')
                         ->with('success', 'Tiket berhasil dibatalkan (Soft Delete).');
    }
}