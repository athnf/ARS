 

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-2xl text-gray-900 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        JADWAL PENERBANGAN TERSEDIA
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <div class="bg-gray-900 p-10 rounded-xl shadow-2xl mb-12 text-center text-white border-t-8 border-gray-700">
                <h1 class="text-4xl md:text-5xl font-black mb-3 uppercase tracking-wider">
                    Pesan Tiket Anda Sekarang
                </h1>
                <p class="text-gray-300 text-lg mb-6">
                    Temukan jadwal terbaik dan harga paling transparan dari Airline Reservation System.
                </p>
                
                <div class="mt-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('user.flights.index')); ?>" class="inline-block px-10 py-3 bg-white text-gray-900 font-extrabold rounded-lg text-base uppercase tracking-widest hover:bg-gray-100 transition duration-300 shadow-xl">
                            LANJUT KE PEMESANAN
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="inline-block px-10 py-3 bg-white text-gray-900 font-extrabold rounded-lg text-base uppercase tracking-widest hover:bg-gray-100 transition duration-300 shadow-xl">
                            LOGIN / DAFTAR
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            
            <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b pb-2">
                Pilihan Penerbangan Terdekat (<?php echo e($flights->count()); ?> Rute)
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 transition duration-300 hover:shadow-xl hover:border-gray-900 relative group">
                        
                        <div class="p-6">
                            
                            <p class="text-xs text-gray-500 mb-3 flex justify-between items-center font-mono">
                                <span class="uppercase tracking-widest"><?php echo e($flight->airline); ?></span>
                                <span class="text-sm font-semibold text-gray-800"><?php echo e($flight->flight_number); ?></span>
                            </p>
                            
                            
                            <h3 class="text-2xl font-extrabold text-gray-900 mb-4 border-b border-gray-100 pb-3">
                                <span class="text-gray-900"><?php echo e($flight->departure_airport_code); ?></span> 
                                <span class="text-gray-400 font-light mx-1">&rarr;</span> 
                                <span class="text-gray-900"><?php echo e($flight->arrival_airport_code); ?></span>
                            </h3>
                            
                            
                            <div class="text-sm space-y-2 mb-4">
                                <p class="flex justify-between items-center">
                                    <span class="font-medium text-gray-700">Keberangkatan:</span>
                                    <span class="font-bold text-gray-900"><?php echo e($flight->scheduled_departure->format('d M H:i')); ?></span>
                                </p>
                                <p class="flex justify-between items-center">
                                    <span class="font-medium text-gray-700">Harga Dasar:</span>
                                    <span class="text-xl font-extrabold text-gray-900">Rp<?php echo e(number_format($flight->base_price, 0, ',', '.')); ?></span>
                                </p>
                            </div>

                        </div>
                        
                        
                        <div class="p-4 bg-gray-50 border-t border-gray-200">
                             <?php if(auth()->guard()->check()): ?>
                                <a href="<?php echo e(route('user.flights.create', $flight->id)); ?>" class="block text-center px-4 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-black transition duration-150 shadow-md text-sm uppercase">
                                    Pesan Sekarang
                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="block text-center px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition duration-150 text-sm uppercase">
                                    Login untuk Memesan
                                </a>
                            <?php endif; ?>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-full bg-white p-10 rounded-xl shadow-lg text-center border-l-4 border-gray-900">
                        <p class="text-lg text-gray-600">
                            Saat ini tidak ada jadwal penerbangan yang tersedia. Silakan cek kembali nanti.
                        </p>
                    </div>
                <?php endif; ?>
            </div>
            
            
            <div class="mt-10 pt-6 border-t border-gray-200 text-center">
                <a href="<?php echo e(route('login')); ?>" class="text-gray-600 font-semibold hover:text-gray-900 transition duration-150 border-b border-gray-400 pb-1">
                    Lihat semua jadwal dengan login ke akun Anda &rarr;
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/welcome.blade.php ENDPATH**/ ?>