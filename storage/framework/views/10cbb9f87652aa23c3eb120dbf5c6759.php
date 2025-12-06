

<?php $__env->startSection('header'); ?>
    <?php echo e('Kelola Penerbangan'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
    <h3 class="text-2xl font-bold mb-4">Daftar Penerbangan Aktif</h3>

    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>
    
    <div class="flex justify-end mb-4">
        <a href="<?php echo e(route('admin.flights.create')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150">
            + Tambah Penerbangan Baru
        </a>
    </div>

    
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
                <?php $__empty_1 = true; $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($flight->flight_number); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($flight->departure_city); ?> (<?php echo e($flight->departure_airport_code); ?>) → <?php echo e($flight->arrival_city); ?> (<?php echo e($flight->arrival_airport_code); ?>)</td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($flight->airline); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($flight->scheduled_departure->format('d M H:i')); ?></td> 
                        
                        <td class="px-6 py-4 whitespace-nowrap">Rp<?php echo e(number_format($flight->base_price, 0, ',', '.')); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?php echo e(route('admin.flights.edit', $flight)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            
                            
                            <form action="<?php echo e(route('admin.flights.destroy', $flight)); ?>" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penerbangan ini?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data penerbangan yang tersedia. Silakan tambahkan satu.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/flights/index.blade.php ENDPATH**/ ?>