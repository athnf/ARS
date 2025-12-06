@extends('admin.layouts.app')

@section('header')
    {{ 'Tambah Penerbangan Baru' }}
@endsection

@section('admin_content')
    <h3 class="text-2xl font-bold mb-6">Form Tambah Penerbangan</h3>

    <form action="{{ route('admin.flights.store') }}" method="POST" class="space-y-6">
        @csrf

        {{-- Pesan Error Validasi --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Oops!</strong> Ada masalah dengan input Anda:
                <ul class="mt-2 list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Baris 1: Nomor Penerbangan & Maskapai --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="flight_number" class="block text-sm font-medium text-gray-700">Nomor Penerbangan</label>
                <input type="text" name="flight_number" id="flight_number"
                       value="{{ old('flight_number') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="airline" class="block text-sm font-medium text-gray-700">Maskapai</label>
                <input type="text" name="airline" id="airline"
                       value="{{ old('airline') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- Baris 1.5: Tipe Pesawat + Kapasitas Kursi --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="aircraft_type" class="block text-sm font-medium text-gray-700">
                    Tipe Pesawat (Contoh: B737, A320)
                </label>
                <input type="text" name="aircraft_type" id="aircraft_type"
                       value="{{ old('aircraft_type') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('aircraft_type')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Kursi</label>
                <input type="number" name="capacity" id="capacity"
                       value="{{ old('capacity') }}" required min="10"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- Baris 2: Kota Asal & Tujuan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="departure_city" class="block text-sm font-medium text-gray-700">Kota Asal</label>
                <input type="text" name="departure_city" id="departure_city"
                       value="{{ old('departure_city') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="arrival_city" class="block text-sm font-medium text-gray-700">Kota Tujuan</label>
                <input type="text" name="arrival_city" id="arrival_city"
                       value="{{ old('arrival_city') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- Baris 3: Kode Bandara Asal & Tujuan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="departure_airport_code" class="block text-sm font-medium text-gray-700">
                    Kode Bandara Asal (IATA 3 Huruf)
                </label>
                <input type="text" name="departure_airport_code" id="departure_airport_code"
                       value="{{ old('departure_airport_code') }}" maxlength="3" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm uppercase">
            </div>

            <div>
                <label for="arrival_airport_code" class="block text-sm font-medium text-gray-700">
                    Kode Bandara Tujuan (IATA 3 Huruf)
                </label>
                <input type="text" name="arrival_airport_code" id="arrival_airport_code"
                       value="{{ old('arrival_airport_code') }}" maxlength="3" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm uppercase">
            </div>
        </div>

        {{-- Baris 4: Jadwal Keberangkatan & Kedatangan --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="scheduled_departure" class="block text-sm font-medium text-gray-700">
                    Jadwal Keberangkatan
                </label>
                <input type="datetime-local" name="scheduled_departure" id="scheduled_departure"
                       value="{{ old('scheduled_departure') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="scheduled_arrival" class="block text-sm font-medium text-gray-700">
                    Jadwal Kedatangan
                </label>
                <input type="datetime-local" name="scheduled_arrival" id="scheduled_arrival"
                       value="{{ old('scheduled_arrival') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- Baris 5: Harga Dasar Tiket --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="base_price" class="block text-sm font-medium text-gray-700">
                    Harga Dasar Tiket (Rp)
                </label>
                <input type="number" name="base_price" id="base_price"
                       value="{{ old('base_price') }}" required min="0" step="1000"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex justify-start pt-4">
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 mr-4">
                Simpan Penerbangan
            </button>

            <a href="{{ route('admin.flights.index') }}"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150">
               Batal
            </a>
        </div>
    </form>
@endsection
