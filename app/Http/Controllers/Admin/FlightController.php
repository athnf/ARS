<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Flight;
use Illuminate\Http\Request;

/**
 * FlightController (ADMIN PANEL)
 * ----------------------------------------------------------
 * Fitur:
 * - List penerbangan
 * - Tambah penerbangan
 * - Edit penerbangan
 * - Hapus data
 * - Validasi lengkap
 * - Menggunakan Resource Controller Laravel
 */
class FlightController extends Controller
{
    /**
     * READ: Menampilkan semua penerbangan.
     */
    public function index()
    {
        $flights = Flight::all();
        return view('admin.flights.index', compact('flights'));
    }

    /**
     * CREATE FORM: Menampilkan form tambah data.
     */
    public function create()
    {
        return view('admin.flights.create');
    }

    /**
     * CREATE ACTION: Simpan data penerbangan baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'flight_number' => 'required|string|unique:flights|max:10',
            'airline' => 'required|string|max:100',
            'aircraft_type' => 'required|string|max:50',
            'departure_city' => 'required|string|max:100',
            'arrival_city' => 'required|string|max:100',
            'departure_airport_code' => 'required|string|size:3',
            'arrival_airport_code' => 'required|string|size:3',
            'scheduled_departure' => 'required|date|after:now',
            'scheduled_arrival' => 'required|date|after:scheduled_departure',
            'capacity' => 'required|integer|min:10',
            'base_price' => 'required|numeric|min:0',
        ]);

        Flight::create($validatedData);

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Penerbangan baru berhasil ditambahkan.');
    }

    /**
     * READ SINGLE: Detail penerbangan tertentu.
     */
    public function show(Flight $flight)
    {
        return view('admin.flights.show', compact('flight'));
    }

    /**
     * EDIT FORM: Menampilkan form edit penerbangan.
     */
    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    /**
     * UPDATE ACTION: Update data penerbangan.
     */
    public function update(Request $request, Flight $flight)
    {
        $validatedData = $request->validate([
            'flight_number' => 'required|string|max:10|unique:flights,flight_number,' . $flight->id,
            'airline' => 'required|string|max:100',
            'aircraft_type' => 'required|string|max:50',
            'departure_city' => 'required|string|max:100',
            'arrival_city' => 'required|string|max:100',
            'departure_airport_code' => 'required|string|size:3',
            'arrival_airport_code' => 'required|string|size:3',
            'scheduled_departure' => 'required|date',
            'scheduled_arrival' => 'required|date|after:scheduled_departure',
            'capacity' => 'required|integer|min:10',
            'base_price' => 'required|numeric|min:0',
        ]);

        $flight->update($validatedData);

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Data penerbangan berhasil diperbarui.');
    }

    /**
     * DELETE ACTION.
     */
    public function destroy(Flight $flight)
    {
        $flight->delete();

        return redirect()
            ->route('admin.flights.index')
            ->with('success', 'Penerbangan berhasil dihapus.');
    }
}
