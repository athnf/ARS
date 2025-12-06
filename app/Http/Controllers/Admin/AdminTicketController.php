<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Flight;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    /**
     * List semua tiket (termasuk soft deleted)
     */
    public function index()
    {
        $tickets = Ticket::withTrashed()
                         ->with(['user', 'flight'])
                         ->latest()
                         ->paginate(20);

        $flights = Flight::all();

        return view('admin.tickets.index', compact('tickets', 'flights'));
    }

    /**
     * DETAIL TIKET (aktif + soft deleted)
     */
    public function show($id)
    {
        $ticket = Ticket::withTrashed()->findOrFail($id);

        $ticket->load(['user', 'flight']);

        return view('admin.tickets.show', compact('ticket'));
    }

    /**
     * Admin menambahkan tiket manual
     */
    public function store(Request $request)
    {
        $request->validate([
            'flight_id'    => 'required|exists:flights,id',
            'user_id'      => 'required|exists:users,id',
            'seat_number'  => 'required|string|unique:tickets,seat_number',
            'price_paid'   => 'required|numeric|min:0',
        ]);

        Ticket::create($request->all());

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Tiket baru berhasil ditambahkan (Admin Insert).');
    }

    /**
     * Soft Delete tiket
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', 'Tiket berhasil dibatalkan (Soft Deleted).');
    }

    /**
     * Restore tiket yang di-soft delete
     */
    public function restore($id)
    {
        $ticket = Ticket::onlyTrashed()->findOrFail($id);

        $ticket->restore();

        return redirect()
            ->route('admin.tickets.index')
            ->with('success', "Tiket ID {$id} berhasil dipulihkan.");
    }
}
