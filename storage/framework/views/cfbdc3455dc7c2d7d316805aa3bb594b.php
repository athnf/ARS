

<?php $__env->startSection('header'); ?>
    <h2 class="font-extrabold text-xl text-gray-800 leading-tight uppercase tracking-wider border-l-4 border-gray-900 pl-3">
        RIWAYAT PEMESANAN TIKET
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            
            <div class="mb-8 p-6 bg-white rounded-xl shadow-md border border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Semua Tiket Anda</h3>
                
                
                <div class="flex flex-wrap gap-3 border-b border-gray-200 pb-2">
                    <?php $currentStatus = request('status') ?? 'all'; ?>

                    <a href="?status=all" class="px-4 py-2 text-sm font-semibold rounded-lg transition duration-150 
                       <?php if($currentStatus === 'all'): ?> bg-gray-900 text-white shadow-md <?php else: ?> text-gray-700 hover:bg-gray-100 <?php endif; ?>">
                        Semua Tiket
                    </a>
                    <a href="?status=upcoming" class="px-4 py-2 text-sm font-semibold rounded-lg transition duration-150 
                       <?php if($currentStatus === 'upcoming'): ?> bg-gray-900 text-white shadow-md <?php else: ?> text-gray-700 hover:bg-gray-100 <?php endif; ?>">
                        Mendatang
                    </a>
                    <a href="?status=completed" class="px-4 py-2 text-sm font-semibold rounded-lg transition duration-150 
                       <?php if($currentStatus === 'completed'): ?> bg-gray-900 text-white shadow-md <?php else: ?> text-gray-700 hover:bg-gray-100 <?php endif; ?>">
                        Selesai
                    </a>
                    <a href="?status=cancelled" class="px-4 py-2 text-sm font-semibold rounded-lg transition duration-150 
                       <?php if($currentStatus === 'cancelled'): ?> bg-gray-900 text-white shadow-md <?php else: ?> text-gray-700 hover:bg-gray-100 <?php endif; ?>">
                        Dibatalkan
                    </a>
                </div>
                
                <p class="text-sm text-gray-500 mt-3">Total <?php echo e($tickets->count()); ?> pemesanan ditemukan.</p>
            </div>

            
            <div class="space-y-6">
                <?php $__empty_1 = true; $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        // Asumsi data ini tersedia dari Controller
                        $flight = $ticket->flight ?? null; 
                        
                        // Status tiket di database (BOOKED, Canceled, Checked-in)
                        $dbStatus = $ticket->status ?? 'UNKNOWN'; 
                        
                        // Cek Soft Delete (Jika ada kolom deleted_at)
                        $isCancelledSoft = $ticket->deleted_at !== null; 

                        // Tentukan Status Final untuk View
                        if ($isCancelledSoft) {
                            $status = 'CANCELLED';
                        } elseif (strtoupper($dbStatus) === 'CHECKED-IN' || $flight && $flight->scheduled_departure < now()) {
                            $status = 'COMPLETED';
                        } else {
                            $status = strtoupper($dbStatus); // Bisa jadi BOOKED
                        }

                        // Logika Styling Status Monokrom - FIXED KEYS
                        $statusClass = [
                            'BOOKED' => 'border-l-4 border-gray-900', // Aktif/Akan Datang
                            'UPCOMING' => 'border-l-4 border-gray-900', // Alias jika ada status upcoming
                            'COMPLETED' => 'border-l-4 border-gray-500', 
                            'CANCELLED' => 'border-l-4 border-gray-700 bg-gray-100 opacity-75', // Visual redup untuk dibatalkan
                            'CHECKED-IN' => 'border-l-4 border-gray-500', // Selesai
                            'UNKNOWN' => 'border-l-4 border-gray-300',
                        ][$status] ?? 'border-l-4 border-gray-300'; // Fallback

                    ?>
                    
                    
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl border border-gray-200 p-6 
                                transition duration-300 hover:shadow-xl hover:border-gray-900 <?php echo e($statusClass); ?>">
                        
                        <div class="md:grid md:grid-cols-5 gap-6 items-center">
                            
                            
                            <div class="md:col-span-2 border-r border-gray-100 md:pr-6 md:mr-6 mb-4 md:mb-0">
                                <span class="px-3 py-1 text-xs font-bold uppercase rounded-full 
                                    <?php if($status === 'BOOKED' || $status === 'UPCOMING'): ?> bg-gray-900 text-white 
                                    <?php elseif($status === 'COMPLETED' || $status === 'CHECKED-IN'): ?> bg-gray-300 text-gray-700 
                                    <?php else: ?> bg-gray-500 text-white <?php endif; ?>">
                                    <?php echo e($status); ?>

                                </span>
                                
                                <h3 class="text-3xl font-black text-gray-900 tracking-tight mt-2">
                                    <?php echo e($flight->departure_airport_code ?? '???'); ?> 
                                    <span class="text-gray-400 font-light mx-1 text-2xl">&rarr;</span> 
                                    <?php echo e($flight->arrival_airport_code ?? '???'); ?>

                                </h3>
                                <p class="text-xs text-gray-600 mt-1">
                                    <?php echo e($flight->airline ?? 'N/A'); ?> | Kursi: <?php echo e($ticket->seat_number); ?>

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

                            
                            <div class="space-y-1 mb-4 md:mb-0 text-sm text-gray-600">
                                <p class="font-medium text-gray-700">ID Pemesanan:</p>
                                <p class="text-md font-mono text-gray-900">ARS-<?php echo e($ticket->id); ?></p>
                            </div>
                            
                            
                            <div class="text-right">
                                <p class="text-sm text-gray-500 uppercase tracking-widest mb-2">Harga Dibayar</p>
                                <p class="text-xl font-black text-gray-900 mb-3">
                                    Rp<?php echo e(number_format($ticket->price_paid, 0, ',', '.')); ?>

                                </p>
                                
                                
                                <?php if($status === 'BOOKED' || $status === 'UPCOMING'): ?>
                                    <form action="<?php echo e(route('user.tickets.destroy', $ticket)); ?>" method="POST" onsubmit="return confirm('Yakin ingin membatalkan tiket ini? Tiket akan di-soft delete.');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white font-medium rounded-lg shadow-sm hover:bg-red-700 transition text-xs uppercase tracking-widest">
                                            Batalkan Tiket
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="<?php echo e(route('user.tickets.show', $ticket->id)); ?>" class="inline-block px-4 py-2 bg-gray-200 text-gray-800 font-medium rounded-lg shadow-sm hover:bg-gray-300 transition text-xs uppercase tracking-widest">
                                        Lihat Detail &rarr;
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    
                    <div class="bg-white p-10 rounded-xl shadow-lg border-l-4 border-gray-600 text-center">
                        <p class="text-xl font-semibold text-gray-800 mb-4">
                            Anda belum memiliki riwayat pemesanan.
                        </p>
                        <a href="<?php echo e(route('user.flights.index')); ?>" class="inline-block px-8 py-3 bg-gray-900 text-white font-bold rounded-lg text-base uppercase tracking-widest hover:bg-black transition duration-300 shadow-xl mt-4">
                            CARI PENERBANGAN
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            
            
            <div class="mt-8">
                <?php echo e($tickets->links()); ?>

            </div>
            
            
            <div class="mt-12 text-center text-xs text-gray-500">
                <p>Data diambil dari log pemesanan sistem ARS. Tiket yang dibatalkan ditandai dengan transparansi visual.</p>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\azhif\Downloads\airline-reservation-system\resources\views/user/tickets/index.blade.php ENDPATH**/ ?>