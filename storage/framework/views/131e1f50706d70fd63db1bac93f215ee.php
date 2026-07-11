<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['class' => 'text-gray-900']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['class' => 'text-gray-900']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $logoType = config('app.logo_type', 'text');
    $logoPath = config('app.site_logo');
    $useImage = $logoType === 'image' && $logoPath && \Illuminate\Support\Facades\Storage::disk('public')->exists($logoPath);
?>
<?php if($useImage): ?>
    <img src="<?php echo e(Storage::url($logoPath)); ?>" alt="<?php echo e(config('app.name')); ?>" class="max-h-10 w-auto <?php echo e($class); ?>">
<?php else: ?>
    <span class="text-xl font-bold <?php echo e($class); ?>"><?php echo e(config('app.name')); ?></span>
<?php endif; ?>
<?php /**PATH D:\dev\htdocs\moorkeys\resources\views/components/logo.blade.php ENDPATH**/ ?>