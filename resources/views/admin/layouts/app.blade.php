@extends('layouts.app') 
{{-- Meng-extend layout dasar Breeze --}}

@section('header')
    <h2 class="font-bold text-xl text-gray-800 leading-tight border-l-4 border-gray-900 pl-3">
        {{ $header ?? 'Kontrol Panel' }} 
    </h2>
@endsection

@section('content')
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    {{-- Konten utama dari halaman spesifik (Dashboard, Flights, dll) --}}
                    @yield('admin_content') 
                </div>
            </div>
        </div>
    </div>
@endsection