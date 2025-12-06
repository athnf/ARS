

<?php $__env->startSection('header'); ?>
    <?php echo e('Kelola Pemesanan Tiket'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
    <h3 class="text-2xl font-bold mb-4">Daftar Semua Pemesanan Tiket</h3>

    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline"><?php echo e(session('success')); ?></span>
        </div>
    <?php endif; ?>
    
    
    <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg shadow-inner mb-6">
        <h4 class="text-lg font-semibold text-yellow-800 mb-3">ADMIN ACTION: Tambah 3 Data Tiket (Demo Poin Dosen)</h4>
        <form action="<?php echo e(route('admin.tickets.store')); ?>" method="POST" class="flex flex-wrap items-end gap-3">
            <?php echo csrf_field(); ?>
            
            <input type="hidden" name="user_id" value="<?php echo e(Auth::id()); ?>"> 
            <input type="hidden" name="price_paid" value="1000000"> 
            
            <div class="w-full md:w-1/4">
                <label for="flight_id" class="block text-xs font-medium text-gray-700">Pilih Penerbangan</label>
                <select name="flight_id" id="flight_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
                    <option value="">-- Pilih Flight --</option>
                    <?php $__currentLoopData = $flights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($flight->id); ?>">[<?php echo e($flight->flight_number); ?>] <?php echo e($flight->departure_airport_code); ?> → <?php echo e($flight->arrival_airport_code); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="w-full md:w-1/6">
                <label for="seat_number" class="block text-xs font-medium text-gray-700">Nomor Kursi (Contoh: A12)</label>
                <input type="text" name="seat_number" id="seat_number" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm text-sm">
            </div>

            <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition duration-150">
                Tambah Tiket (Demo)
            </button>
        </form>
    </div>

    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Flight (Rute)</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kursi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="<?php if($ticket->trashed()): ?> bg-red-50 <?php endif; ?>">
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->id); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->user->name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->flight->flight_number); ?> (<?php echo e($ticket->flight->departure_airport_code); ?> → <?php echo e($ticket->flight->arrival_airport_code); ?>)</td>
                        <td class="px-6 py-4 whitespace-nowrap"><?php echo e($ticket->seat_number); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php if($ticket->trashed()): ?> bg-red-500 text-white
                                <?php elseif($ticket->status == 'Booked'): ?> bg-blue-100 text-blue-800
                                <?php else: ?> bg-green-100 text-green-800
                                <?php endif; ?>">
                                <?php echo e($ticket->trashed() ? 'DIBATALKAN (Soft Deleted)' : $ticket->status); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <?php if($ticket->trashed()): ?>
                                
                                <form action="<?php echo e(route('admin.tickets.restore', $ticket->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin memulihkan tiket ini?');">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="text-green-600 hover:text-green-900">Pulihkan</button>
                                </form>
                            <?php else: ?>
                                
                                <form action="<?php echo e(route('admin.tickets.destroy', $ticket)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan/soft delete tiket ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-900">Batalkan/Soft Delete</button>
                                </form>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada data pemesanan yang tersedia.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <?php echo e($tickets->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/tickets/index.blade.php ENDPATH**/ ?>