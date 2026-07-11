<?php $__env->startSection('title', 'Pages'); ?>
<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <div><h1 class="text-2xl font-bold text-gray-900">Pages</h1><p class="text-gray-600 mt-1">Manage website content pages.</p></div>
    <a href="<?php echo e(route('admin.pages.create')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 text-sm font-medium">Add Page</a>
</div>
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <table class="w-full text-sm">
        <thead><tr class="bg-gray-50 border-b border-gray-200">
            <th class="text-left px-6 py-3 font-medium text-gray-600">Title</th>
            <th class="text-left px-6 py-3 font-medium text-gray-600">Slug</th>
            <th class="text-left px-6 py-3 font-medium text-gray-600">Placement</th>
            <th class="text-left px-6 py-3 font-medium text-gray-600">Status</th>
            <th class="text-left px-6 py-3 font-medium text-gray-600">Published</th>
            <th class="text-right px-6 py-3 font-medium text-gray-600">Actions</th>
        </tr></thead>
        <tbody>
            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="border-b border-gray-100 hover:bg-gray-50">
                <td class="px-6 py-4 font-medium text-gray-900"><?php echo e($page->title); ?></td>
                <td class="px-6 py-4 text-gray-600">/<?php echo e($page->slug); ?></td>
                <td class="px-6 py-4"><?php if($page->placement === 'header'): ?><span class="text-xs font-medium text-indigo-600 bg-indigo-50 px-2 py-1 rounded">Main Menu</span><?php elseif($page->placement === 'footer'): ?><span class="text-xs font-medium text-gray-600 bg-gray-100 px-2 py-1 rounded">Footer</span><?php else: ?><span class="text-xs text-gray-400">&mdash;</span><?php endif; ?></td>
                <td class="px-6 py-4">
                    <span class="px-2 py-1 text-xs font-medium rounded-full <?php echo e($page->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'); ?>"><?php echo e($page->is_published ? 'Published' : 'Draft'); ?></span>
                </td>
                <td class="px-6 py-4 text-gray-600"><?php echo e($page->published_at ? $page->published_at->format('Y-m-d') : '-'); ?></td>
                <td class="px-6 py-4 text-right"><a href="<?php echo e(route('admin.pages.edit', $page)); ?>" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <div class="px-6 py-4 border-t border-gray-200"><?php echo e($pages->links()); ?></div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\dev\htdocs\moorkeys\resources\views/admin/pages/index.blade.php ENDPATH**/ ?>