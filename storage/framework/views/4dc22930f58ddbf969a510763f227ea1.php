

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-red-800 pb-12">
    <!-- Title -->
    <div class="text-center py-4 sm:py-6 md:py-8">
        <div class="inline-block bg-[#D68C45] px-6 sm:px-8 md:px-12 py-2 sm:py-3 md:py-4 rounded-lg transform -rotate-2">
            <h1 class="text-xl sm:text-2xl md:text-3xl font-['Kalam'] font-bold text-white italic">Order Details</h1>
            <p class="text-sm sm:text-base font-['Kalam'] text-white/90 italic">Order #<?php echo e($order->id); ?></p>
        </div>
    </div>

    <!-- Back Button -->
    <div class="w-full max-w-xl mx-auto px-4 mt-8 mb-4">
        <a href="<?php echo e(route('admin.orders')); ?>" 
           class="inline-block bg-white/90 hover:bg-white text-red-800 px-4 py-2 rounded-full text-sm transition-colors shadow-md">
            ← Back to Orders
        </a>
    </div>

    <!-- Receipt Card -->
    <div class="w-full max-w-xl mx-auto px-4">
        <div class="bg-white shadow-xl rounded-lg relative transform hover:-translate-y-1 transition-transform duration-200">
            <!-- Thermal paper texture effect -->
            <div class="absolute inset-0 pointer-events-none opacity-5" 
                 style="background-image: linear-gradient(90deg, rgba(0,0,0,0.05) 1px, transparent 1px), 
                                       linear-gradient(rgba(0,0,0,0.05) 1px, transparent 1px); 
                        background-size: 15px 15px;"></div>

            <!-- Receipt content -->
            <div class="p-8 relative">
                <!-- Logo and Header -->
                <div class="text-center mb-8">
                    <img src="<?php echo e(asset('images/logo2.png')); ?>" alt="Seblak Mama DK" class="h-24 mx-auto mb-3">
                    <div class="text-xs text-gray-500 space-y-1">
                        <p>Jl. Example Street No. 123</p>
                        <p>Phone: (123) 456-7890</p>
                    </div>
                </div>

                <!-- Order Info -->
                <div class="text-center mb-6">
                    <p class="text-lg font-semibold mb-1">#<?php echo e(str_pad($order->id, 6, '0', STR_PAD_LEFT)); ?></p>
                    <p class="text-sm text-gray-500"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></p>
                    <div class="mt-2">
                        <span class="inline-block px-3 py-1 rounded-full text-sm
                            <?php switch($order->status):
                                case ('completed'): ?>
                                    bg-[#90B77D] text-white
                                    <?php break; ?>
                                <?php case ('processing'): ?>
                                    bg-[#D68C45] text-white
                                    <?php break; ?>
                                <?php case ('pending'): ?>
                                    <?php if($order->payment_proof): ?>
                                        bg-[#78A2CC] text-white
                                    <?php endif; ?>
                                    <?php break; ?>
                                <?php case ('rejected'): ?>
                                    bg-red-500 text-white
                                    <?php break; ?>
                            <?php endswitch; ?>">
                            <?php switch($order->status):
                                case ('pending'): ?>
                                    <?php if($order->payment_proof): ?>
                                        Waiting for Confirmation
                                    <?php endif; ?>
                                    <?php break; ?>
                                <?php default: ?>
                                    <?php echo e(ucfirst($order->status)); ?>

                            <?php endswitch; ?>
                        </span>
                    </div>
                </div>

                <!-- Customer Info -->
                <div class="text-sm mb-6">
                    <p><span class="text-gray-500">Customer:</span> <?php echo e($order->user->name); ?></p>
                    <p class="text-gray-500 text-xs"><?php echo e($order->user->email); ?></p>
                </div>

                <!-- Order Items -->
                <div class="mb-6">
                    <div class="space-y-2">
                        <!-- Base Seblak -->
                        <div class="flex justify-between text-sm">
                            <div>
                                <p>Base Seblak</p>
                                <div class="text-xs text-gray-500 flex items-center gap-2">
                                    <span>Spice Level:</span>
                                    <div class="flex gap-0.5">
                                    <?php if($order->spice_level == 0): ?>
                                                                        Level 1 - Tidak Pedas
                                                                    <?php elseif($order->spice_level == 1): ?>
                                                                        Level 2 - Sedang
                                                                    <?php elseif($order->spice_level == 2): ?>
                                                                        Level 3 - Pedas
                                                                    <?php elseif($order->spice_level == 3): ?>
                                                                        Level 4 - Sangat Pedas
                                                                    <?php elseif($order->spice_level == 4): ?>
                                                                        Level 5 - Extra Pedas
                                                                    <?php else: ?>
                                                                        Level <?php echo e($order->spice_level); ?>

                                                                    <?php endif; ?>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500">Consistency: <?php echo e(ucfirst($order->consistency)); ?></p>
                            </div>
                            <span>15,000</span>
                        </div>

                        <!-- Toppings -->
                        <?php $__currentLoopData = $order->toppings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">+ <?php echo e($topping->name); ?></span>
                            <span><?php echo e(number_format($topping->price)); ?></span>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Total -->
                    <div class="border-t border-gray-200 mt-4 pt-4">
                        <div class="flex justify-between font-semibold">
                            <span>TOTAL</span>
                            <span>Rp <?php echo e(number_format($order->total_price)); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Payment Proof -->
                <?php if($order->payment_proof): ?>
                <div class="mb-6">
                    <p class="text-sm text-gray-500 mb-2">Payment Proof</p>
                    <img src="<?php echo e(asset('storage/' . $order->payment_proof)); ?>" 
                         class="w-full rounded shadow-sm" 
                         alt="Payment Proof">
                </div>
                <?php endif; ?>

                <!-- Action Buttons -->
                <div class="flex justify-end gap-2 mt-6">
                    <?php if($order->status === 'pending'): ?>
                        <button type="button"
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-full text-sm transition-colors"
                                onclick="document.getElementById('rejectModal').classList.remove('hidden')">
                            Reject
                        </button>
                        <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                    name="status" 
                                    value="processing"
                                    class="bg-[#90B77D] hover:bg-[#90B77D]/90 text-white px-4 py-2 rounded-full text-sm transition-colors">
                                Accept
                            </button>
                        </form>
                    <?php endif; ?>
                    <?php if($order->status === 'processing'): ?>
                        <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" 
                                    name="status" 
                                    value="completed"
                                    class="bg-[#90B77D] hover:bg-[#90B77D]/90 text-white px-4 py-2 rounded-full text-sm transition-colors">
                                Complete
                            </button>
                        </form>
                    <?php endif; ?>
                </div>

                <!-- Rejection Reason -->
                <?php if($order->rejection_reason): ?>
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <p class="text-sm text-red-500">Rejection Reason:</p>
                    <p class="text-sm text-gray-600 mt-1"><?php echo e($order->rejection_reason); ?></p>
                </div>
                <?php endif; ?>

                <!-- Receipt Footer -->
                <div class="text-center text-xs text-gray-400 mt-8">
                    <p>Thank you for your order!</p>
                    <p><?php echo e(now()->format('d/m/Y H:i:s')); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold mb-4">Reject Order</h3>
            <form action="<?php echo e(route('admin.orders.reject', $order)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-4">
                    <label for="reason" class="block text-sm text-gray-700 mb-2">Rejection Reason</label>
                    <textarea id="reason" 
                              name="reason" 
                              rows="3" 
                              class="w-full rounded-lg border-gray-300"
                              required></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" 
                            onclick="document.getElementById('rejectModal').classList.add('hidden')"
                            class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-full text-sm transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-full text-sm transition-colors">
                        Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
.min-h-screen {
    background-color: #991B1B;
}

main {
    background-color: #991B1B;
}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\mira3\Downloads\seblakFINALLY\resources\views/admin/orders/view.blade.php ENDPATH**/ ?>