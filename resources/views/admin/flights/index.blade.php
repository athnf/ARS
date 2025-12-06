@extends('admin.layouts.app')

@section('header')
    {{ 'Kelola Penerbangan' }}
@endsection

@section('admin_content')
    <h3 class="text-2xl font-bold mb-4">Daftar Penerbangan Aktif</h3>

    {{-- Pesan Sukses (Success Message) dari Controller --}}
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('admin.flights.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150">
            + Tambah Penerbangan Baru
        </a>
    </div>

    {{-- Tabel Daftar Penerbangan --}}
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Flight</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rute</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Maskapai</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keberangkatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Dasar</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($flights as $flight)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $flight->flight_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $flight->departure_city }} ({{ $flight->departure_airport_code }}) → {{ $flight->arrival_city }} ({{ $flight->arrival_airport_code }})</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $flight->airline }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $flight->scheduled_departure->format('d M H:i') }}</td> 
                        {{-- Memanfaatkan Casting 'datetime' di Model Flight --}}
                        <td class="px-6 py-4 whitespace-nowrap">Rp{{ number_format($flight->base_price, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.flights.edit', $flight) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            
                            {{-- Form Delete (Menggunakan method DELETE) --}}
                            <form action="{{ route('admin.flights.destroy', $flight) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penerbangan ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data penerbangan yang tersedia. Silakan tambahkan satu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection