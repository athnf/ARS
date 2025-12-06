 

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-xl text-gray-800 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        CARI & PESAN TIKET PENERBANGAN
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <div class="mb-8 p-6 bg-white rounded-xl shadow-md border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Jadwal Penerbangan Tersedia</h3>
                <p class="text-gray-500">Menampilkan semua penerbangan yang tersedia dan belum melewati waktu keberangkatan.</p>
                
                
                <div class="mt-4 border-t border-gray-100 pt-4">
                    <form class="flex space-x-3">
                        <input type="text" placeholder="Asal (CGK)" class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm focus:border-gray-500 focus:ring-gray-500">
                        <input type="text" placeholder="Tujuan (DPS)" class="flex-1 border-gray-300 rounded-lg shadow-sm text-sm focus:border-gray-500 focus:ring-gray-500">
                        <button type="submit" class="px-6 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-black transition text-sm">
                            Cari
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="space-y-4">
                <?php $__empty_1 = true; $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 p-6 
                                transition duration-300 hover:shadow-xl hover:border-gray-900">
                        
                        <div class="md:grid md:grid-cols-5 gap-6 items-center">
                            
                            
                            <div class="md:col-span-2 border-r border-gray-100 md:pr-6 md:mr-6 mb-4 md:mb-0">
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-widest mb-1"><?php echo e($flight->airline); ?> - <?php echo e($flight->aircraft_type); ?></p>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="text-center">
                                        <p class="text-2xl font-black text-gray-900"><?php echo e($flight->scheduled_departure->format('H:i')); ?></p>
                                        <p class="text-sm text-gray-600"><?php echo e($flight->departure_airport_code); ?></p>
                                    </div>
                                    <div class="flex-1 text-center border-t border-dashed border-gray-400">
                                        <span class="text-sm text-gray-500">~</span>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-2xl font-black text-gray-900"><?php echo e($flight->scheduled_arrival->format('H:i')); ?></p>
                                        <p class="text-sm text-gray-600"><?php echo e($flight->arrival_airport_code); ?></p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">Tanggal: <?php echo e($flight->scheduled_departure->format('d F Y')); ?></p>
                            </div>

                            
                            <div class="space-y-2 mb-4 md:mb-0">
                                <p class="text-sm font-medium text-gray-900 uppercase"><?php echo e($flight->flight_number); ?></p>
                                <p class="text-md text-gray-700">
                                    <?php echo e($flight->departure_city); ?> &rarr; <?php echo e($flight->arrival_city); ?>

                                </p>
                            </div>

                            
                            <div class="space-y-1 mb-4 md:mb-0 text-sm text-gray-600">
                                <p>Kursi: <?php echo e($flight->capacity); ?></p>
                                <p>Tipe Pesawat: <?php echo e($flight->aircraft_type); ?></p>
                            </div>
                            
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-500 uppercase tracking-widest mb-2">Harga Mulai Dari</p>
                                <p class="text-2xl font-black text-gray-900 mb-3">
                                    Rp<?php echo e(number_format($flight->base_price, 0, ',', '.')); ?>

                                </p>
                                
                                
                                <a href="<?php echo e(route('user.flights.create', $flight->id)); ?>" class="inline-block px-5 py-2 bg-gray-900 text-white font-semibold rounded-lg shadow-md hover:bg-black transition text-sm uppercase tracking-widest">
                                    Pesan Sekarang &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <div class="bg-white p-10 rounded-xl shadow-lg border-l-4 border-gray-600 text-center">
                        <p class="text-xl font-semibold text-gray-800 mb-4">
                            Tidak ada jadwal penerbangan yang tersedia saat ini.
                        </p>
                        <p class="text-gray-500">
                            Silakan coba kombinasi rute atau tanggal lain.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
            
            <div class="mt-8">
                <?php echo e($flights->links()); ?>

            </div>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/user/flights/index.blade.php ENDPATH**/ ?>