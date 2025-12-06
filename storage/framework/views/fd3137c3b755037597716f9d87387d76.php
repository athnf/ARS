

<?php $__env->startSection('header'); ?>
    <?php echo e('Audit Log Aktivitas Sistem'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
    <h3 class="text-2xl font-bold mb-4">Daftar Aktivitas Sistem (Audit Log)</h3>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 shadow-md rounded-lg">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tabel</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Record</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($log->created_at->format('d M Y H:i:s')); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
                            <?php echo e($log->user ? $log->user->name . ' (' . $log->user->role . ')' : 'Sistem/Unknown'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                <?php if($log->action == 'CREATE' || $log->action == 'RESTORE'): ?> bg-green-100 text-green-800
                                <?php elseif($log->action == 'UPDATE' || $log->action == 'LOGIN'): ?> bg-blue-100 text-blue-800
                                <?php elseif($log->action == 'DELETE' || $log->action == 'SOFT DELETE'): ?> bg-red-100 text-red-800
                                <?php else: ?> bg-gray-100 text-gray-800
                                <?php endif; ?>">
                                <?php echo e($log->action); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($log->table_name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($log->record_id ?? '-'); ?></td>
                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate"><?php echo e($log->description); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Belum ada aktivitas yang dicatat.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-4">
        <?php echo e($logs->links()); ?>

    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/audit-log/index.blade.php ENDPATH**/ ?>