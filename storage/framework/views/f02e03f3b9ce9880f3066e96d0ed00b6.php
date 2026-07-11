<?php $__env->startSection('title', 'Key Details'); ?>
<?php $__env->startSection('content'); ?>
<div class="mb-6"><a href="<?php echo e(route('admin.keys.index')); ?>" class="text-indigo-600 hover:text-indigo-800 text-sm">&larr; Back to Keys</a></div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Key Details</h2>
            <dl class="grid grid-cols-2 gap-4">
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Key</dt><dd class="mt-1 font-mono text-lg font-bold text-gray-900"><?php echo e($activationKey->key); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Status</dt><dd class="mt-1"><span class="px-2 py-1 text-xs font-medium rounded-full <?php if($activationKey->status === 'active'): ?> bg-green-100 text-green-700 <?php elseif($activationKey->status === 'expired'): ?> bg-red-100 text-red-700 <?php else: ?> bg-gray-100 text-gray-700 <?php endif; ?>"><?php echo e($activationKey->status); ?></span></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Owner</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->user->name ?? 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Plan</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->plan->name ?? 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Product Type</dt><dd class="mt-1 text-gray-900 capitalize"><?php echo e($activationKey->product_type); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Domain</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->domain ?? 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Name</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->client_name ?? 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Client Email</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->client_email ?? 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Claimed By</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->owner?->name ?? $activationKey->owner?->email ?? 'Not claimed'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Activated</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->activated_at ? $activationKey->activated_at->format('Y-m-d H:i') : 'N/A'); ?></dd></div>
                <div><dt class="text-xs font-medium text-gray-500 uppercase">Expires</dt><dd class="mt-1 text-gray-900"><?php echo e($activationKey->expires_at ? $activationKey->expires_at->format('Y-m-d H:i') : 'Never'); ?></dd></div>
            </dl>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Event Log</h2>
            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $activationKey->events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div><p class="text-sm font-medium text-gray-900 capitalize"><?php echo e(str_replace('_', ' ', $event->event_type)); ?></p><p class="text-xs text-gray-500"><?php echo e($event->ip_address ?? 'N/A'); ?></p></div>
                        <span class="text-xs text-gray-500"><?php echo e($event->created_at->diffForHumans()); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">No events logged.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Quick Actions</h3>
            <div class="space-y-2">
                <a href="<?php echo e(route('admin.keys.edit', $activationKey)); ?>" class="block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm">Edit Key</a>
                <form method="POST" action="<?php echo e(route('admin.keys.destroy', $activationKey)); ?>" onsubmit="return confirm('Delete this key?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="block w-full text-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm">Delete Key</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\dev\htdocs\moorkeys\resources\views/admin/keys/show.blade.php ENDPATH**/ ?>