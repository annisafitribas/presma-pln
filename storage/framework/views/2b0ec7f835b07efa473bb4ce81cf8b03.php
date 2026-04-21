<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'align' => 'left', // left | center | right
    'width' => null,
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
    'align' => 'left', // left | center | right
    'width' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$alignClass = match($align) {
    'center' => 'text-center',
    'right' => 'text-right',
    default => 'text-left',
};
?>

<th <?php echo e($attributes->merge([
    'class' => trim("
        px-4 py-3 font-semibold border-x border-[#2B3467]
        bg-[#BAD7E9] text-black
        {$alignClass}
        " . ($width ? "w-{$width}" : '')
    )
])); ?>>
    <?php echo e($slot); ?>

</th>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/components/table-th.blade.php ENDPATH**/ ?>