<?php if (isset($component)) { $__componentOriginal1340a54fa1e54268cb28788a33cb7851 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1340a54fa1e54268cb28788a33cb7851 = $attributes; } ?>
<?php $component = App\View\Components\AppadminLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('appadmin-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppadminLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center gap-2 text-[#0D1B2A]">
            <span class="font-semibold">Profil</span>
        </div>
     <?php $__env->endSlot(); ?>

    <?php
        $admin = auth()->user();
    ?>

    <div class="bg-white p-8 rounded-2xl shadow border space-y-8">

        <div class="flex flex-col items-center text-center space-y-3">
            <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-blue-100 shadow
                        bg-gray-100 flex items-center justify-center">

                <?php if($admin->foto): ?>
                    <img
                        src="<?php echo e(asset('storage/' . $admin->foto)); ?>"
                        alt="Foto <?php echo e($admin->name); ?>"
                        class="w-full h-full object-cover"
                    >
                <?php else: ?>
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-user'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-14 h-14 text-gray-400']); ?>
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
                <?php endif; ?>

            </div>

            <div>
                <h2 class="text-xl font-bold text-[#0D1B2A]">
                    <?php echo e($admin->name); ?>

                </h2>

                <span class="inline-block mt-1 px-4 py-1 text-sm rounded-full bg-blue-50 text-blue-700 font-semibold">
                    Admin
                </span>
            </div>
        </div>

        
        <section class="space-y-4">
            <h3 class="flex items-center gap-2 font-semibold text-lg border-b pb-2">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-user-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6']); ?>
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
                Data Profil Admin
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Email','value' => $admin->email]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($admin->email)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $attributes = $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $component = $__componentOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Jenis Kelamin','value' => $admin->gender === 'L'
                        ? 'Laki-laki'
                        : ($admin->gender === 'P' ? 'Perempuan' : '-')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Jenis Kelamin','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($admin->gender === 'L'
                        ? 'Laki-laki'
                        : ($admin->gender === 'P' ? 'Perempuan' : '-'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $attributes = $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $component = $__componentOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Tanggal Lahir','value' => optional($admin->tgl_lahir)->format('d-m-Y') ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tanggal Lahir','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($admin->tgl_lahir)->format('d-m-Y') ?? '-')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $attributes = $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $component = $__componentOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Nomor HP','value' => $admin->no_hp ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Nomor HP','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($admin->no_hp ?? '-')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $attributes = $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $component = $__componentOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Alamat','value' => $admin->alamat ?? '-','full' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Alamat','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($admin->alamat ?? '-'),'full' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $attributes = $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__attributesOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23)): ?>
<?php $component = $__componentOriginal43721b2dc50f0e44e77553fa73f72f23; ?>
<?php unset($__componentOriginal43721b2dc50f0e44e77553fa73f72f23); ?>
<?php endif; ?>
            </div>
        </section>

        
        <div class="flex justify-end gap-3 pt-6 border-t">
            <?php if (isset($component)) { $__componentOriginale21d90f41251e682846d7af3e3cbbb3b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale21d90f41251e682846d7af3e3cbbb3b = $attributes; } ?>
<?php $component = App\View\Components\ButtonLink::resolve(['href' => ''.e(route('admin.profile.edit')).'','variant' => 'primary','icon' => 'heroicon-o-pencil-square'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ButtonLink::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                Edit
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale21d90f41251e682846d7af3e3cbbb3b)): ?>
<?php $attributes = $__attributesOriginale21d90f41251e682846d7af3e3cbbb3b; ?>
<?php unset($__attributesOriginale21d90f41251e682846d7af3e3cbbb3b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale21d90f41251e682846d7af3e3cbbb3b)): ?>
<?php $component = $__componentOriginale21d90f41251e682846d7af3e3cbbb3b; ?>
<?php unset($__componentOriginale21d90f41251e682846d7af3e3cbbb3b); ?>
<?php endif; ?>
        </div>

    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1340a54fa1e54268cb28788a33cb7851)): ?>
<?php $attributes = $__attributesOriginal1340a54fa1e54268cb28788a33cb7851; ?>
<?php unset($__attributesOriginal1340a54fa1e54268cb28788a33cb7851); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1340a54fa1e54268cb28788a33cb7851)): ?>
<?php $component = $__componentOriginal1340a54fa1e54268cb28788a33cb7851; ?>
<?php unset($__componentOriginal1340a54fa1e54268cb28788a33cb7851); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/admin/profile_show.blade.php ENDPATH**/ ?>