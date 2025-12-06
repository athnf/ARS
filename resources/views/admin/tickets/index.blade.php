@extends('admin.layouts.app')

@section('header')
    {{ 'Kelola Pemesanan Tiket' }}
@endsection

@section('admin_content')
    <h3 class="text-2xl font-bold mb-4">Daftar Semua Pemesanan Tiket</h3>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    {{-- Form Insert 3 Data (untuk memenuhi poin dosen) --}}
    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg shadow-inner mb-6">
        <h4 class="text-lg font-semibold text-yellow-800 mb-3">ADMIN ACTION: Tambah 3 Data Tiket (Demo Poin Dosen)</h4>
        <form action="{{ route('admin.tickets.store') }}" method="POST" class="flex flex-wrap items-end gap-3">
            @csrf
            
            <input type="hidden" name="user_id" value="{{ Auth::id() }}"> 
            <input type="hidden" name="price_paid" value="1000000"> {{-- Harga dummy --}}
            
            <div class="w-full md:w-1/4">
                <label for="flight_id" class="block text-xs font-medium text-gray-700">Pilih Penerbangan</label>
                <select name="flight_id" id="flight_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                    <option value="">-- Pilih Flight --</option>
                    @foreach($flights as $flight)
                        <option value="{{ $flight->id }}">[{{ $flight->flight_number }}] {{ $flight->departure_airport_code }} → {{ $flight->arrival_airport_code }}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-full md:w-1/6">
                <label for="seat_number" class="block text-xs font-medium text-gray-700">Nomor Kursi (Contoh: A12)</label>
                <input type="text" name="seat_number" id="seat_number" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
            </div>

            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-150">
                Tambah Tiket (Demo)
            </button>
        </form>
    </div>

    {{-- Tabel Daftar Tiket --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flight (Rute)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($tickets as $ticket)
                    <tr class="@if($ticket->trashed()) bg-red-50 @endif">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->flight->flight_number }} ({{ $ticket->flight->departure_airport_code }} → {{ $ticket->flight->arrival_airport_code }})</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $ticket->seat_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($ticket->trashed()) bg-red-500 text-white
                                @elseif($ticket->status == 'Booked') bg-blue-100 text-blue-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ $ticket->trashed() ? 'DIBATALKAN (Soft Deleted)' : $ticket->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($ticket->trashed())
                                {{-- Form Restore (Pulihkan) --}}
                                <form action="{{ route('admin.tickets.restore', $ticket->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin memulihkan tiket ini?');">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-900">Pulihkan</button>
                                </form>
                            @else
                                {{-- Form Delete (Batalkan/Soft Delete) --}}
                                <form action="{{ route('admin.tickets.destroy', $ticket) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan/soft delete tiket ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Batalkan/Soft Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data pemesanan yang tersedia.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tickets->links() }}
    </div>
@endsection