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
        <div class="flex items-center justify-between gap-3">
            <span class="font-semibold text-[#0D1B2A]">
                Riwayat Presensi
            </span>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="container mx-auto">
        <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

            
            <div class="flex items-center gap-2 mb-4">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-archive-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-6 h-6 text-[#0D1B2A]']); ?>
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
                <h2 class="text-lg font-semibold text-[#0D1B2A]">
                    Riwayat Presensi Peserta
                </h2>
            </div>

            <?php if($users->count()): ?>

                
                <div class="hidden md:block">
                    <div class="-mx-6 overflow-x-auto">
                        <div class="min-w-[800px] px-6">

                            <?php if (isset($component)) { $__componentOriginal163c8ba6efb795223894d5ffef5034f5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal163c8ba6efb795223894d5ffef5034f5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table','data' => ['class' => 'text-sm w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-sm w-full']); ?>
                                <thead>
                                    <tr>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-12 whitespace-nowrap']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-12 whitespace-nowrap']); ?>No <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Nama <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Hadir <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Telat <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Sakit <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Izin <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Alpha <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center','class' => 'w-28']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center','class' => 'w-28']); ?>Pending <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal215abb4c13efe247e49c1b629be1a8e4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-th','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-th'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?>Aksi <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $attributes = $__attributesOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__attributesOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4)): ?>
<?php $component = $__componentOriginal215abb4c13efe247e49c1b629be1a8e4; ?>
<?php unset($__componentOriginal215abb4c13efe247e49c1b629be1a8e4); ?>
<?php endif; ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="hover:bg-[#0D1B2A1A] even:bg-[#F8FAFC] transition">

                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?>
                                                <?php echo e(($users->currentPage() - 1) * $users->perPage() + $loop->iteration); ?>

                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>

                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                                <div class="flex items-center gap-2">
                                                    <span class="font-semibold">
                                                        <?php echo e($user->name); ?>

                                                    </span>

                                                    <?php
                                                        $status = optional($user->profile)->status_magang;
                                                    ?>

                                                    <?php if($status === 'Aktif'): ?>
                                                        <span
                                                            class="px-2 py-[4px] text-[10px] leading-none rounded-full bg-green-100 text-green-700 font-semibold">
                                                            Aktif
                                                        </span>
                                                    <?php else: ?>
                                                        <span
                                                            class="px-2 py-[4px] text-[10px] leading-none rounded-full bg-red-100 text-red-700 font-semibold">
                                                            Tidak Aktif
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>

                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_hadir); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_telat); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_sakit); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_izin); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_alpha); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?><?php echo e($user->total_pending); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>

                                            <?php if (isset($component)) { $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.table-td','data' => ['align' => 'center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('table-td'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['align' => 'center']); ?>
                                                <a href="<?php echo e(route('admin.presensi.show', $user->id)); ?>"
                                                    class="text-blue-600 hover:underline text-sm font-semibold">
                                                    Detail
                                                </a>
                                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $attributes = $__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__attributesOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33)): ?>
<?php $component = $__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33; ?>
<?php unset($__componentOriginal9d7cdefa54c145bd4c6e0ac8804e8d33); ?>
<?php endif; ?>

                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $attributes = $__attributesOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__attributesOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal163c8ba6efb795223894d5ffef5034f5)): ?>
<?php $component = $__componentOriginal163c8ba6efb795223894d5ffef5034f5; ?>
<?php unset($__componentOriginal163c8ba6efb795223894d5ffef5034f5); ?>
<?php endif; ?>

                        </div>
                    </div>
                </div>

                
                <div class="md:hidden space-y-4">

                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">

                            
                            <div class="flex items-center justify-between mb-4">

                                <div>
                                    <div class="flex items-center gap-2">
                                        <p class="font-semibold text-[#0D1B2A] text-sm">
                                            <?php echo e($user->name); ?>

                                        </p>

                                        <?php
                                            $status = optional($user->profile)->status_magang;
                                        ?>

                                        <?php if($status === 'Aktif'): ?>
                                            <span
                                                class="px-2 py-0.5 text-[10px] rounded-full bg-green-100 text-green-700 font-semibold">
                                                Aktif
                                            </span>
                                        <?php else: ?>
                                            <span
                                                class="px-2 py-0.5 text-[10px] rounded-full bg-red-100 text-red-700 font-semibold">
                                                Tidak Aktif
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-xs text-gray-400">
                                        <?php echo e(optional(optional($user->profile)->bidang)->nama ?? '-'); ?>

                                    </p>
                                </div>

                                <a href="<?php echo e(route('admin.presensi.show', $user->id)); ?>"
                                    class="text-blue-600 hover:underline text-sm font-semibold">
                                    Detail
                                </a>

                            </div>

                            
                            <div class="grid grid-cols-6 text-center border-t border-gray-200 pt-3">

                                <div>
                                    <p class="text-gray-400 text-[11px]">Hadir</p>
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($user->total_hadir); ?>

                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Telat</p>
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($user->total_telat); ?>

                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Sakit</p>
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($user->total_sakit); ?>

                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Izin</p>
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($user->total_izin); ?>

                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Alpha</p>
                                    <p class="font-semibold text-gray-800">
                                        <?php echo e($user->total_alpha); ?>

                                    </p>
                                </div>

                                <div>
                                    <p class="text-gray-400 text-[11px]">Pending</p>
                                    <p class="font-semibold text-yellow-600">
                                        <?php echo e($user->total_pending); ?>

                                    </p>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <div class="flex justify-end mt-6 px-6">
                    <?php echo e($users->onEachSide(1)->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center font-semibold py-10 flex flex-col items-center gap-2">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-folder-minus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12 text-[#CBD5E1]']); ?>
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
                    <span>Belum ada data presensi</span>
                </div>

            <?php endif; ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $attributes = $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64)): ?>
<?php $component = $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64; ?>
<?php unset($__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64); ?>
<?php endif; ?>
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
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/admin/presensi_index.blade.php ENDPATH**/ ?>