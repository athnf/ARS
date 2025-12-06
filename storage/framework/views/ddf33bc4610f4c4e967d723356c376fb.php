

<?php $__env->startSection('header'); ?>
    <?php echo e('Tambah Penerbangan Baru'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin_content'); ?>
    <h3 class="text-2xl font-bold mb-6">Form Tambah Penerbangan</h3>

    <form action="<?php echo e(route('admin.flights.store')); ?>" method="POST" class="space-y-6">
        <?php echo csrf_field(); ?>

        
        <?php if($errors->any()): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                <strong class="font-bold">Oops!</strong> Ada masalah dengan input Anda:
                <ul class="mt-2 list-disc ml-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="flight_number" class="block text-sm font-medium text-gray-700">Nomor Penerbangan</label>
                <input type="text" name="flight_number" id="flight_number"
                       value="<?php echo e(old('flight_number')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
            <div>
                <label for="airline" class="block text-sm font-medium text-gray-700">Maskapai</label>
                <input type="text" name="airline" id="airline"
                       value="<?php echo e(old('airline')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="aircraft_type" class="block text-sm font-medium text-gray-700">
                    Tipe Pesawat (Contoh: B737, A320)
                </label>
                <input type="text" name="aircraft_type" id="aircraft_type"
                       value="<?php echo e(old('aircraft_type')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <?php $__errorArgs = ['aircraft_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Kursi</label>
                <input type="number" name="capacity" id="capacity"
                       value="<?php echo e(old('capacity')); ?>" required min="10"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="departure_city" class="block text-sm font-medium text-gray-700">Kota Asal</label>
                <input type="text" name="departure_city" id="departure_city"
                       value="<?php echo e(old('departure_city')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="arrival_city" class="block text-sm font-medium text-gray-700">Kota Tujuan</label>
                <input type="text" name="arrival_city" id="arrival_city"
                       value="<?php echo e(old('arrival_city')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="departure_airport_code" class="block text-sm font-medium text-gray-700">
                    Kode Bandara Asal (IATA 3 Huruf)
                </label>
                <input type="text" name="departure_airport_code" id="departure_airport_code"
                       value="<?php echo e(old('departure_airport_code')); ?>" maxlength="3" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm uppercase">
            </div>

            <div>
                <label for="arrival_airport_code" class="block text-sm font-medium text-gray-700">
                    Kode Bandara Tujuan (IATA 3 Huruf)
                </label>
                <input type="text" name="arrival_airport_code" id="arrival_airport_code"
                       value="<?php echo e(old('arrival_airport_code')); ?>" maxlength="3" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm uppercase">
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="scheduled_departure" class="block text-sm font-medium text-gray-700">
                    Jadwal Keberangkatan
                </label>
                <input type="datetime-local" name="scheduled_departure" id="scheduled_departure"
                       value="<?php echo e(old('scheduled_departure')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="scheduled_arrival" class="block text-sm font-medium text-gray-700">
                    Jadwal Kedatangan
                </label>
                <input type="datetime-local" name="scheduled_arrival" id="scheduled_arrival"
                       value="<?php echo e(old('scheduled_arrival')); ?>" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="base_price" class="block text-sm font-medium text-gray-700">
                    Harga Dasar Tiket (Rp)
                </label>
                <input type="number" name="base_price" id="base_price"
                       value="<?php echo e(old('base_price')); ?>" required min="0" step="1000"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>
        </div>

        
        <div class="flex justify-start pt-4">
            <button type="submit"
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition duration-150 mr-4">
                Simpan Penerbangan
            </button>

            <a href="<?php echo e(route('admin.flights.index')); ?>"
               class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition duration-150">
               Batal
            </a>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/admin/flights/create.blade.php ENDPATH**/ ?>