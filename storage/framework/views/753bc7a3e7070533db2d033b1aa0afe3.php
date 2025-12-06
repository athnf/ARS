 


<?php $__env->startSection('header'); ?>
    <h2 class="font-bold text-xl text-gray-800 leading-tight border-l-4 border-gray-900 pl-3">
        <?php echo e($header ?? 'Kontrol Panel'); ?> 
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-gray-200">
                <div class="p-8 text-gray-900">
                    
                    <?php echo $__env->yieldContent('admin_content'); ?> 
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/layouts/app.blade.php ENDPATH**/ ?>