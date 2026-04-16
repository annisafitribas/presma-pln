<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'label',
    'value' => '-',
    'full' => false,
]));

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

foreach (array_filter(([
    'label',
    'value' => '-',
    'full' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="<?php echo e($full ? 'md:col-span-2' : ''); ?> space-y-1">
    <p class="text-sm text-gray-500"><?php echo e($label); ?></p>
    <p class="font-semibold text-gray-800">
        <?php echo e($value ?: '-'); ?>

    </p>
</div>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/components/show-item.blade.php ENDPATH**/ ?>