<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('content'); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Overview of your MoorKeys system.</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Users</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['total_users']); ?></p>
                </div>
                <div class="p-3 bg-indigo-50 rounded-lg"><svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197"/></svg></div>
            </div>
            <p class="text-sm text-gray-500 mt-2"><?php echo e($stats['total_clients']); ?> clients</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Activation Keys</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['total_keys']); ?></p>
                </div>
                <div class="p-3 bg-green-50 rounded-lg"><svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg></div>
            </div>
            <p class="text-sm text-green-600 mt-2"><?php echo e($stats['active_keys']); ?> active</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Subscriptions</p>
                    <p class="text-3xl font-bold text-gray-900 mt-1"><?php echo e($stats['active_subscriptions']); ?></p>
                </div>
                <div class="p-3 bg-purple-50 rounded-lg"><svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            </div>
            <p class="text-sm text-gray-500 mt-2"><?php echo e($stats['total_plans']); ?> plans</p>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h2>
            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $stats['recent_users']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-indigo-100 text-indigo-700 rounded-full flex items-center justify-center text-sm font-medium"><?php echo e(substr($user->name, 0, 2)); ?></div>
                            <div><p class="text-sm font-medium text-gray-900"><?php echo e($user->name); ?></p><p class="text-xs text-gray-500"><?php echo e($user->email); ?></p></div>
                        </div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo e($user->role === 'super_admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700'); ?>"><?php echo e(str_replace('_', ' ', $user->role)); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">No users yet.</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Keys</h2>
            <div class="space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $stats['recent_keys']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-0">
                        <div><p class="text-sm font-mono font-medium text-gray-900"><?php echo e($key->key); ?></p><p class="text-xs text-gray-500"><?php echo e($key->user->name ?? 'N/A'); ?></p></div>
                        <span class="px-2 py-1 text-xs font-medium rounded-full 
                            <?php if($key->status === 'active'): ?> bg-green-100 text-green-700
                            <?php elseif($key->status === 'expired'): ?> bg-red-100 text-red-700
                            <?php elseif($key->status === 'revoked'): ?> bg-gray-100 text-gray-700
                            <?php else: ?> bg-yellow-100 text-yellow-700 <?php endif; ?>"><?php echo e($key->status); ?></span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">No keys yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\dev\htdocs\moorkeys\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>