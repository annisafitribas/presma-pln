<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'value' => null,
    'options' => [],
    'placeholder' => 'Pilih',
    'submit' => false,
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
    'name',
    'value' => null,
    'options' => [],
    'placeholder' => 'Pilih',
    'submit' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div
    x-data="{ open:false, selected:<?php echo \Illuminate\Support\Js::from($value)->toHtml() ?> }"
    class="relative w-full"
    x-modelable="selected"
>
    <input type="hidden" name="<?php echo e($name); ?>" :value="selected">

    
    <button type="button"
        @click="open = !open"
        class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl border
               bg-white text-sm font-medium text-gray-700 hover:border-[#0D1B2A]">
        <span
            x-text="
                selected
                ? Object.entries(<?php echo \Illuminate\Support\Js::from($options)->toHtml() ?>).find(([k]) => k == selected)?.[1]
                : '<?php echo e($placeholder); ?>'
            "
        ></span>
        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chevron-down'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-4 h-4 text-gray-400']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
    </button>

    
    <div x-show="open" x-transition @click.outside="open=false"
         class="absolute z-20 mt-2 w-full bg-white border rounded-xl shadow-lg p-1">

        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button
                type="button"
                @click="
                    selected='<?php echo e($key); ?>';
                    open=false;
                    $dispatch('select-change', { name:'<?php echo e($name); ?>', value:selected });
                    <?php echo e($submit ? 'setTimeout(() => $el.closest(\'form\').submit(), 100)' : ''); ?>

                "
                class="
                    w-full text-left px-4 py-2 text-sm
                    rounded-lg
                    hover:bg-[#0D1B2A]/10
                    transition
                "
            >
                <?php echo e($label); ?>

            </button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/components/select-box.blade.php ENDPATH**/ ?>