 

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-xl text-gray-800 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        KONFIRMASI DAN PEMBAYARAN TIKET
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white rounded-xl shadow-2xl border border-gray-200">
                <div class="p-8">

                    <h3 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-200 pb-3">
                        Pesan Penerbangan: <?php echo e($flight->departure_airport_code); ?> &rarr; <?php echo e($flight->arrival_airport_code); ?>

                    </h3>
                    
                    
                    <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-300 shadow-inner">
                        <h4 class="text-xl font-extrabold text-gray-900 mb-4">Detail Penerbangan</h4>
                        
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <p><strong class="text-gray-600">Maskapai:</strong> <span class="font-semibold"><?php echo e($flight->airline); ?></span></p>
                            <p><strong class="text-gray-600">Nomor Flight:</strong> <span class="font-semibold"><?php echo e($flight->flight_number); ?></span></p>
                            
                            <p><strong class="text-gray-600">Berangkat:</strong> <span class="font-semibold"><?php echo e($flight->scheduled_departure->format('d M Y, H:i')); ?></span></p>
                            <p><strong class="text-gray-600">Kedatangan:</strong> <span class="font-semibold"><?php echo e($flight->scheduled_arrival->format('d M Y, H:i')); ?></span></p>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200">
                             <p class="text-xl font-bold text-gray-900 uppercase tracking-widest">
                                HARGA: Rp<?php echo e(number_format($flight->base_price, 0, ',', '.')); ?>

                            </p>
                        </div>
                    </div>

                    
                    
                    
                    <?php if($errors->any()): ?>
                        <div class="mb-4 p-4 bg-gray-100 border-l-4 border-red-500 text-red-700">
                            <strong class="font-bold">Error Validasi:</strong> Mohon periksa kembali input Anda.
                            <ul class="mt-2 list-disc ml-5 text-sm">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('user.tickets.store')); ?>" method="POST" class="space-y-6">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="flight_id" value="<?php echo e($flight->id); ?>">

                        <h4 class="text-xl font-bold text-gray-800 mb-4 border-b border-gray-100 pb-2">Detail Penumpang</h4>

                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Penumpang (Sesuai Akun)</label>
                                <p class="mt-1 text-base font-semibold text-gray-900 p-2 bg-gray-50 rounded-md border border-gray-300">
                                    <?php echo e(Auth::user()->name); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email Kontak</label>
                                <p class="mt-1 text-base font-semibold text-gray-900 p-2 bg-gray-50 rounded-md border border-gray-300">
                                    <?php echo e(Auth::user()->email); ?>

                                </p>
                            </div>
                        </div>

                        
                        <div>
                            <label for="seat_number" class="block text-sm font-medium text-gray-700">Nomor Kursi yang Dipilih</label>
                            <input type="text" name="seat_number" id="seat_number" value="<?php echo e(old('seat_number')); ?>" required 
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm uppercase text-lg focus:border-gray-900 focus:ring-gray-900" 
                                placeholder="Contoh: 12A">
                            <p class="text-xs text-gray-500 mt-1">Masukkan nomor kursi yang Anda inginkan (Akan divalidasi ketersediaannya).</p>
                            <?php $__errorArgs = ['seat_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        
                        <div class="pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center mb-4">
                                <label class="block text-xl font-extrabold text-gray-900">TOTAL YANG HARUS DIBAYAR</label>
                                <p class="text-3xl font-black text-gray-900">
                                    Rp<?php echo e(number_format($flight->base_price, 0, ',', '.')); ?>

                                </p>
                            </div>

                            <button type="submit" class="w-full px-6 py-4 bg-gray-900 text-white font-extrabold rounded-lg shadow-xl hover:bg-black transition duration-200 uppercase tracking-widest text-lg">
                                KONFIRMASI & BAYAR SEKARANG
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="mt-8 text-center text-xs text-gray-500">
                <p>Pembayaran dilakukan secara *instant* dan final. Pastikan data penumpang sudah benar.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/user/flights/create.blade.php ENDPATH**/ ?>