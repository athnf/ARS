

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-xl text-gray-800 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        PANEL PENGGUNA ARS
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200 mb-10">
                <div class="md:flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">
                            Selamat Datang, <?php echo e(Auth::user()->name); ?>

                        </h1>
                        <p class="text-gray-500 text-lg">
                            Lihat pemesanan Anda atau mulai pencarian penerbangan baru.
                        </p>
                    </div>

                    
                    <div class="mt-6 md:mt-0 flex-shrink-0">
                        <a href="<?php echo e(route('user.flights.index')); ?>" class="inline-flex items-center justify-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg shadow-xl hover:bg-black transition duration-200 text-sm uppercase tracking-widest">
                            CARI PENERBANGAN BARU &rarr;
                        </a>
                    </div>
                </div>
            </div>

            
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-300 pb-2">
                Penerbangan Mendatang (Upcoming Trips)
            </h2>

            <div class="grid grid-cols-1 gap-6">
                
                <?php $__empty_1 = true; $__currentLoopData = $upcomingTickets ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        // Asumsi variabel flight tersedia
                        $flight = $ticket->flight ?? null; 
                    ?>
                    
                    
                    <div class="bg-white rounded-xl shadow-md border border-gray-200 p-6 
                                transition duration-300 hover:shadow-xl hover:border-gray-900">
                        
                        <div class="md:grid md:grid-cols-4 gap-6 items-center">
                            
                            
                            <div class="md:col-span-2 border-r border-gray-100 md:pr-6 md:mr-6 mb-4 md:mb-0">
                                <p class="text-xs text-gray-500 font-medium uppercase tracking-widest mb-1"><?php echo e($flight->airline ?? 'Maskapai N/A'); ?></p>
                                
                                <h3 class="text-3xl font-black text-gray-900 tracking-tight">
                                    <?php echo e($flight->departure_airport_code ?? '???'); ?> 
                                    <span class="text-gray-400 font-light mx-1 text-2xl">&rarr;</span> 
                                    <?php echo e($flight->arrival_airport_code ?? '???'); ?>

                                </h3>
                                <p class="text-xs text-gray-600 mt-1">
                                    Flight: <span class="font-semibold"><?php echo e($flight->flight_number ?? 'N/A'); ?></span> | Kursi: <span class="font-semibold"><?php echo e($ticket->seat_number); ?></span>
                                </p>
                            </div>

                            
                            <div class="space-y-1 mb-4 md:mb-0 border-l border-gray-100 pl-4">
                                <p class="text-sm font-medium text-gray-700">Berangkat:</p>
                                <p class="text-lg font-bold text-gray-900">
                                    <?php echo e($flight->scheduled_departure->format('d M Y') ?? 'N/A'); ?>

                                </p>
                                <p class="text-md font-semibold text-gray-800">
                                    <?php echo e($flight->scheduled_departure->format('H:i') ?? ''); ?> WIB
                                </p>
                            </div>

                            
                            <div class="text-right">
                                <p class="text-sm text-gray-500 uppercase tracking-widest mb-2">Harga Tiket</p>
                                <p class="text-xl font-black text-gray-900 mb-3">
                                    Rp<?php echo e(number_format($ticket->price_paid, 0, ',', '.')); ?>

                                </p>
                                
                                
                                <a href="<?php echo e(route('user.tickets.show', $ticket->id)); ?>" class="inline-block px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-md shadow-sm hover:bg-gray-300 transition text-xs uppercase tracking-widest">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <div class="bg-white p-10 rounded-xl shadow-lg border-l-4 border-gray-600 text-center">
                        <p class="text-xl font-semibold text-gray-800 mb-4">
                            Tidak ada tiket penerbangan yang akan datang.
                        </p>
                        <a href="<?php echo e(route('user.flights.index')); ?>" class="inline-block px-8 py-3 bg-gray-900 text-white font-bold rounded-lg text-base uppercase tracking-widest hover:bg-black transition duration-300 shadow-xl mt-4">
                            MULAI PERJALANAN BARU
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            
            <div class="mt-10 pt-4 border-t border-gray-200">
                <h4 class="text-xl font-bold mb-4 text-gray-800">Akses Cepat</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                 
                    
                    <a href="<?php echo e(route('user.tickets.index')); ?>" class="bg-white p-4 rounded-lg border border-gray-300 shadow-sm flex items-center justify-between transition duration-200 hover:bg-gray-100">
                        <p class="text-md font-semibold text-gray-800">Riwayat Pemesanan (Semua Tiket)</p>
                        <span class="text-xl font-extrabold text-gray-900 opacity-60">&rarr;</span>
                    </a>

                    
                    <a href="<?php echo e(route('user.flights.index')); ?>" class="bg-white p-4 rounded-lg border border-gray-300 shadow-sm flex items-center justify-between transition duration-200 hover:bg-gray-100">
                        <p class="text-md font-semibold text-gray-800">Cari & Pesan Tiket Baru</p>
                        <span class="text-xl font-extrabold text-gray-900 opacity-60">&rarr;</span>
                    </a>
                    
                    
                    <a href="<?php echo e(route('profile.edit')); ?>" class="bg-white p-4 rounded-lg border border-gray-300 shadow-sm flex items-center justify-between transition duration-200 hover:bg-gray-100">
                        <p class="text-md font-semibold text-gray-800">Edit Profil & Keamanan</p>
                        <span class="text-xl font-extrabold text-gray-900 opacity-60">&rarr;</span>
                    </a>
                </div>
            </div>

            
            <div class="mt-12 text-center text-xs text-gray-500">
                <p>Airline Reservation System (ARS) - Dilindungi oleh Enkripsi AES-256.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/user/dashboard.blade.php ENDPATH**/ ?>