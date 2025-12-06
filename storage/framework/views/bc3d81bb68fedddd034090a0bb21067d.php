

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        DASHBOARD PENGELOLA SISTEM
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="p-0">
        <h3 class="text-3xl font-bold mb-1 text-gray-900">Selamat Datang di ARS Control!</h3>
        <p class="mb-8 text-gray-500 text-lg">Ringkasan operasional real-time dan akses cepat manajemen.</p>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <?php
                // Definisikan array status untuk loop (agar lebih profesional)
                $stats = [
                    ['label' => 'Total Penerbangan', 'count' => $totalFlights, 'icon' => '✈️', 'route' => route('admin.flights.index')],
                    ['label' => 'Pemesanan Aktif', 'count' => $totalBookings, 'icon' => '🎫', 'route' => route('admin.tickets.index')],
                    ['label' => 'Tiket Dibatalkan', 'count' => $totalCancelled, 'icon' => '❌', 'route' => route('admin.tickets.index')],
                    ['label' => 'Aktivitas Tercatat', 'count' => 'LOG', 'icon' => '📜', 'route' => route('admin.audit-log.index')],
                ];
            ?>

            <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-100 transition duration-300 hover:shadow-xl hover:border-gray-900">
                    <p class="text-xs text-gray-500 font-semibold uppercase tracking-widest mb-1"><?php echo e($stat['label']); ?></p>
                    <div class="flex items-end justify-between">
                         <p class="text-4xl font-black text-gray-900 mt-1"><?php echo e($stat['count']); ?></p>
                         <span class="text-3xl opacity-50"><?php echo e($stat['icon']); ?></span>
                    </div>
                    <a href="<?php echo e($stat['route']); ?>" class="text-sm text-gray-600 hover:text-gray-900 font-medium mt-3 block border-t border-gray-200 pt-3">
                        Lihat Detail &rarr;
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <hr class="my-10 border-t border-gray-200">

        
        <h4 class="text-xl font-extrabold mb-6 text-gray-800 border-b border-gray-200 pb-2">Manajemen Cepat & Operasi Utama</h4>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-300 shadow-md">
                <h5 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                    <span class="mr-2 text-2xl opacity-70">✈️</span> Data Penerbangan (Flights)
                </h5>
                <p class="text-gray-600 mb-5 text-sm">Kelola master data jadwal, rute, dan harga dasar penerbangan.</p>
                
                <div class="flex justify-between space-x-3">
                    <a href="<?php echo e(route('admin.flights.create')); ?>" class="flex-1 text-center px-4 py-3 bg-gray-900 text-white font-bold rounded-lg hover:bg-black transition shadow-lg text-sm uppercase">
                        + Tambah Baru
                    </a>
                    <a href="<?php echo e(route('admin.flights.index')); ?>" class="flex-1 text-center px-4 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition text-sm uppercase border border-gray-300">
                        Lihat Semua
                    </a>
                </div>
            </div>

            
            <div class="bg-gray-50 p-6 rounded-lg border border-gray-300 shadow-md">
                <h5 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                    <span class="mr-2 text-2xl opacity-70">🎫</span> Data Pemesanan & Recovery
                </h5>
                <p class="text-gray-600 mb-5 text-sm">Monitor pemesanan, pulihkan tiket yang dibatalkan, dan tinjau log sistem.</p>

                <div class="flex justify-between space-x-3">
                    <a href="<?php echo e(route('admin.tickets.index')); ?>" class="flex-1 text-center px-4 py-3 bg-gray-800 text-white font-bold rounded-lg hover:bg-gray-900 transition shadow-lg text-sm uppercase">
                        Kelola Tiket
                    </a>
                     <a href="<?php echo e(route('admin.audit-log.index')); ?>" class="flex-1 text-center px-4 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition text-sm uppercase border border-gray-300">
                        Audit Log
                    </a>
                </div>
            </div>
        </div>

        
        <div class="mt-12 pt-5 border-t border-gray-200 text-center text-sm text-gray-500">
            <p>Airline Reservation System (ARS) &copy; <?php echo e(date('Y')); ?></p>
            <p class="mt-1 text-xs">Akses Kontrol Terproteksi. Semua aktivitas dicatat.
                <a href="<?php echo e(route('admin.audit-log.index')); ?>" class="text-gray-600 hover:text-black font-medium">Lihat Log.</a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>