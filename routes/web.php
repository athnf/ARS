<?php

use Illuminate\Support\Facades\Route;

// Public + User Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Admin Controllers
use App\Http\Controllers\Admin\FlightController;
use App\Http\Controllers\Admin\AuditLogController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\AdminDashboardController;

// User Controllers (root folder, bukan folder User/)
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserTicketController;

/*
|--------------------------------------------------------------------------
| Public Route (Home)
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Breeze Default /dashboard REMOVED
|--------------------------------------------------------------------------
| Sudah tidak digunakan karena redirect login menggunakan role-based routing.
|
| // Route::get('/dashboard', ...)
|
*/

/*
|--------------------------------------------------------------------------
| User Profile Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard Admin
        Route::get('/', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Flights
        Route::resource('flights', FlightController::class);

        // Audit Log
        Route::get('audit-log', [AuditLogController::class, 'index'])
            ->name('audit-log.index');

        // CRUD Tiket Admin (exclude edit & update ONLY)
        Route::resource('tickets', AdminTicketController::class)
            ->except(['edit', 'update']);

        // Restore Tiket Soft Delete
        Route::post('tickets/{id}/restore', [AdminTicketController::class, 'restore'])
            ->name('tickets.restore')
            ->where('id', '[0-9]+');
    });

/*
|--------------------------------------------------------------------------
| User Booking & Tickets Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

        // Dashboard User
        Route::get('/dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');

        // Lihat daftar penerbangan
        Route::get('flights', [BookingController::class, 'index'])
            ->name('flights.index');

        // Form booking penerbangan tertentu
        Route::get('flights/{flight}/book', [BookingController::class, 'create'])
            ->name('flights.create');

        // Proses booking
        Route::post('tickets', [BookingController::class, 'store'])
            ->name('tickets.store');

        // Kelola tiket user (index + destroy)
        Route::resource('tickets', UserTicketController::class)
            ->only(['index', 'destroy']);
    });

/*
|--------------------------------------------------------------------------
| Breeze Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
