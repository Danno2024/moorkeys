<?php $__env->startSection('title', 'Invoice Templates'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Invoice Templates</h1><p class="text-gray-600 mt-1">Manage invoice and receipt templates.</p></div>
    <a href="<?php echo e(route('admin.invoice-templates.create')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add Template</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead><tr class="bg-gray-50 border-b border-gray-200">
                <th class="text-left px-6 py-3 font-medium text-gray-600">Name</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Subject</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Default</th>
                <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
                <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
            </tr></thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($template->name); ?></td>
                    <td class="px-6 py-4 text-gray-600"><?php echo e($template->subject); ?></td>
                    <td class="px-6 py-4"><?php echo $template->is_default ? '<span class="text-green-600 font-bold">&check;</span>' : '<span class="text-gray-300">&mdash;</span>'; ?></td>
                    <td class="px-6 py-4"><span class="px-2 py-1 text-xs font-medium rounded-full <?php echo e($template->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'); ?>"><?php echo e($template->is_active ? 'Active' : 'Inactive'); ?></span></td>
                    <td class="px-6 py-4 text-right"><div class="flex items-center justify-end gap-3"><a href="<?php echo e(route('admin.invoice-templates.preview', $template)); ?>" class="text-gray-600 hover:text-gray-800 text-sm font-medium" target="_blank">Preview</a><a href="<?php echo e(route('admin.invoice-templates.edit', $template)); ?>" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a></div></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="5" class="px-6 py-12 text-center text-gray-500">No invoice templates yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\dev\htdocs\moorkeys\resources\views/admin/invoice-templates/index.blade.php ENDPATH**/ ?>