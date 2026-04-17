<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'duration' => 1500,
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
    'duration' => 1500,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div x-data="{
    show: false,
    title: 'Berhasil',
    message: '',
    progress: 0,
    start() {
        this.progress = 0;
        this.show = true;

        let step = 100 / (<?php echo e($duration); ?> / 16);
        let interval = setInterval(() => {
            this.progress += step;
            if (this.progress >= 100) {
                clearInterval(interval);
                this.show = false;
            }
        }, 16);
    }
}"
    x-on:user-toast.window="
        title = $event.detail.title ?? 'Berhasil';
        message = $event.detail.message ?? '';
        start();
    "
    x-show="show" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-cloak
    class="fixed inset-0 z-50 flex items-center justify-center">
    <!-- BACKDROP -->
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>

    <!-- TOAST CARD -->
    <div
        class="relative bg-white rounded-2xl shadow-2xl w-[80vw] sm:w-full sm:max-w-sm px-5 py-5 sm:px-7 sm:py-6 text-center">

        
        <div class="flex justify-center mb-4 relative">
            <svg class="w-16 h-16 rotate-[-90deg]">
                <circle cx="32" cy="32" r="28" stroke-width="4" class="text-gray-200"
                    stroke="currentColor" fill="transparent" />
                <circle cx="32" cy="32" r="28" stroke-width="4"
                    class="text-green-600 transition-all duration-75" stroke="currentColor" fill="transparent"
                    stroke-dasharray="176" :stroke-dashoffset="176 - (176 * progress / 100)" />
            </svg>

            
            <div class="absolute inset-0 flex items-center justify-center">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-7 h-7 text-green-600']); ?>
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
            </div>
        </div>

        
        <h3 class="text-base font-semibold text-gray-800 mb-1" x-text="title">
        </h3>

        
        <p class="text-sm text-gray-600" x-text="message">
        </p>
    </div>
</div>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/components/user-toast.blade.php ENDPATH**/ ?>