@extends('admin.layouts.app')

@section('header')
    {{ 'Detail Tiket: ' . $ticket->id }}
@endsection

@section('admin_content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-2xl font-bold mb-4">Detail Tiket</h3>

        {{-- Tampilkan Status Soft Delete --}}
        @if ($ticket->trashed())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                <p class="font-bold">Dibatalkan (Soft Deleted)</p>
                <p>Tiket ini telah dibatalkan pada {{ $ticket->deleted_at->format('d M Y H:i') }}.</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- KOLOM KIRI: INFO PEMESANAN --}}
            <div>
                <h4 class="text-xl font-semibold border-b pb-2 mb-4">Informasi Pemesanan</h4>
                <p class="mb-2"><strong class="font-medium">ID Tiket:</strong> {{ $ticket->id }}</p>
                <p class="mb-2"><strong class="font-medium">Tanggal Booking:</strong> {{ $ticket->created_at->format('d M Y H:i') }}</p>
                <p class="mb-2"><strong class="font-medium">Total Harga:</strong> Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</p>
            </div>
            
            {{-- KOLOM KANAN: INFO PENUMPANG --}}
            <div>
                <h4 class="text-xl font-semibold border-b pb-2 mb-4">Informasi Penumpang</h4>
                <p class="mb-2"><strong class="font-medium">Nama Penumpang:</strong> {{ $ticket->user->name ?? 'N/A' }}</p>
                <p class="mb-2"><strong class="font-medium">Email:</strong> {{ $ticket->user->email ?? 'N/A' }}</p>
            </div>
        </div>

        <hr class="my-6">

        {{-- INFO PENERBANGAN --}}
        <h4 class="text-xl font-semibold border-b pb-2 mb-4">Detail Penerbangan</h4>
        <p class="mb-2"><strong class="font-medium">Nomor Penerbangan:</strong> {{ $ticket->flight->flight_number ?? 'N/A' }}</p>
        <p class="mb-2"><strong class="font-medium">Rute:</strong> {{ $ticket->flight->departure_city ?? 'N/A' }} ({{ $ticket->flight->departure_airport_code ?? 'N/A' }}) &rarr; {{ $ticket->flight->arrival_city ?? 'N/A' }} ({{ $ticket->flight->arrival_airport_code ?? 'N/A' }})</p>
        <p class="mb-2"><strong class="font-medium">Jadwal Keberangkatan:</strong> {{ $ticket->flight->scheduled_departure?->format('d M Y H:i') ?? 'N/A' }}</p>

        {{-- Tombol Kembali --}}
        <div class="mt-6 flex justify-start">
            <a href="{{ route('admin.tickets.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition duration-150">
                &larr; Kembali ke Daftar Tiket
            </a>

            {{-- Tombol Restore (Jika tiket di-soft delete) --}}
            @if ($ticket->trashed())
                <form action="{{ route('admin.tickets.restore', $ticket->id) }}" method="POST" class="ml-3">
                    @csrf
                    {{-- Tambahkan method PATCH atau PUT jika diperlukan, tergantung route Anda. Asumsi Anda menggunakan PATCH untuk restore --}}
                    {{-- @method('PATCH') --}} 
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-150">
                        Pulihkan Tiket
                    </button>
                </form>
            @endif
        </div>
    </div>
@endsection