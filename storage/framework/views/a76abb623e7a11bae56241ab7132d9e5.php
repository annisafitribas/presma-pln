<?php if (isset($component)) { $__componentOriginalb143a286fba2d785c473946bdb901dc1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb143a286fba2d785c473946bdb901dc1 = $attributes; } ?>
<?php $component = App\View\Components\AppuserLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('appuser-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppuserLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

    
     <?php $__env->slot('header', null, []); ?> 
        <span class="font-semibold text-[#0D1B2A]">Profil Saya</span>
     <?php $__env->endSlot(); ?>

    <div x-data="{
        openPasswordModal: false,
        showOld: false,
        showNew: false,
        showConfirm: false
    }" class="space-y-6 mb-6">

        
        <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative']); ?>

            
            <div class="flex justify-end">
                <?php if (isset($component)) { $__componentOriginal109b8580f126ec393f14abedafe0e4b7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal109b8580f126ec393f14abedafe0e4b7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-button-link','data' => ['href' => ''.e(route('user.profile.edit')).'','icon' => 'heroicon-o-pencil','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-button-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('user.profile.edit')).'','icon' => 'heroicon-o-pencil','size' => 'sm']); ?>
                    Edit
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal109b8580f126ec393f14abedafe0e4b7)): ?>
<?php $attributes = $__attributesOriginal109b8580f126ec393f14abedafe0e4b7; ?>
<?php unset($__attributesOriginal109b8580f126ec393f14abedafe0e4b7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal109b8580f126ec393f14abedafe0e4b7)): ?>
<?php $component = $__componentOriginal109b8580f126ec393f14abedafe0e4b7; ?>
<?php unset($__componentOriginal109b8580f126ec393f14abedafe0e4b7); ?>
<?php endif; ?>
            </div>

            
            <div class="flex flex-col items-center space-y-3 mt-4 text-center">

                <div
                    class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden 
                   border-4 border-blue-100 shadow bg-gray-100 
                   flex items-center justify-center">

                    <?php if($user->avatar_url): ?>
                        <img src="<?php echo e($user->avatar_url); ?>" alt="Foto <?php echo e($user->name); ?>"
                            class="w-full h-full object-cover">
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
                    <h2 class="text-lg md:text-xl font-bold text-gray-800">
                        <?php echo e($user->name); ?>

                    </h2>
                    <span
                        class="inline-block mt-1 px-4 py-1 text-sm rounded-full 
                       bg-blue-50 text-blue-700 font-semibold">
                        Peserta Magang
                    </span>
                </div>

            </div>

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
        
        <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'space-y-4']); ?>
            <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-identification'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-600']); ?>
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
                Data Pribadi
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Nama Lengkap','value' => $user->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Nama Lengkap','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->name)]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Email','value' => $user->email]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->email)]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Jenis Kelamin','value' => $user->gender === 'L' ? 'Laki-laki' : ($user->gender === 'P' ? 'Perempuan' : '-')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Jenis Kelamin','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->gender === 'L' ? 'Laki-laki' : ($user->gender === 'P' ? 'Perempuan' : '-'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Tanggal Lahir','value' => optional($user->tgl_lahir)->format('d-m-Y') ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tanggal Lahir','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($user->tgl_lahir)->format('d-m-Y') ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'No. HP','value' => $user->no_hp ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'No. HP','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->no_hp ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Alamat','value' => $user->alamat ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Alamat','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->alamat ?? '-')]); ?>
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

        
        <?php if($user->profile): ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'space-y-4']); ?>
                <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-academic-cap'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-600']); ?>
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
                    Akademik
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Pendidikan','value' => $user->profile->pendidikan ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pendidikan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->pendidikan ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Tingkatan','value' => $user->profile->tingkatan ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tingkatan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->tingkatan ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Kelas / Semester','value' => $user->profile->kelas ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Kelas / Semester','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->kelas ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Jurusan','value' => $user->profile->jurusan ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Jurusan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->jurusan ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Nomor Induk','value' => $user->profile->nomor_induk ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Nomor Induk','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->nomor_induk ?? '-')]); ?>
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
        <?php endif; ?>

        
        <?php if($user->profile): ?>
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'space-y-4']); ?>
                <div class="flex items-center justify-between">
                    <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-rectangle-stack'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-600']); ?>
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
                        Penempatan Magang
                    </h3>

                    <span
                        class="px-3 py-1 rounded-full text-xs font-semibold
                    <?php echo e($user->profile->status_magang === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600'); ?>">
                        <?php echo e($user->profile->status_magang); ?>

                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Bidang','value' => optional($user->profile->bidang)->nama ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Bidang','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($user->profile->bidang)->nama ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Pembimbing','value' => optional($user->profile->pembimbing->user)->name ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Pembimbing','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($user->profile->pembimbing->user)->name ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Tanggal Masuk','value' => optional($user->profile->tgl_masuk)->format('d-m-Y') ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tanggal Masuk','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($user->profile->tgl_masuk)->format('d-m-Y') ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Tanggal Keluar','value' => optional($user->profile->tgl_keluar)->format('d-m-Y') ?? '-']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Tanggal Keluar','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(optional($user->profile->tgl_keluar)->format('d-m-Y') ?? '-')]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Sisa Hari Magang','value' => $user->profile->sisa_hari . ' hari']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Sisa Hari Magang','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user->profile->sisa_hari . ' hari')]); ?>
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
        <?php endif; ?>

        
        <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'space-y-4']); ?>
            <h3 class="flex items-center gap-2 font-semibold text-lg text-gray-700">
                <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-lock-closed'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-blue-600']); ?>
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
                Keamanan Akun
            </h3>

            <?php if (isset($component)) { $__componentOriginal43721b2dc50f0e44e77553fa73f72f23 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43721b2dc50f0e44e77553fa73f72f23 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.show-item','data' => ['label' => 'Password','value' => '********']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('show-item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Password','value' => '********']); ?>
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

            <?php if (isset($component)) { $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-button','data' => ['variant' => 'secondary','icon' => 'heroicon-o-key','xOn:click' => '$dispatch(\'open-modal\', \'change-password\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'secondary','icon' => 'heroicon-o-key','x-on:click' => '$dispatch(\'open-modal\', \'change-password\')']); ?>
                Ubah Password
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $attributes = $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $component = $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
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

        
        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'change-password','show' => session('open_password_modal'),'maxWidth' => 'md','focusable' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'change-password','show' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('open_password_modal')),'maxWidth' => 'md','focusable' => true]); ?>

            <div class="p-6">

                
                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-800">
                            Ubah Password
                        </h3>

                        <button type="button" x-on:click="$dispatch('close-modal', 'change-password')">
                            <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-x-mark'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 text-gray-500']); ?>
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
                    </div>

                    <p class="text-xs text-gray-500">
                        Password minimal 6 karakter.
                    </p>
                </div>

                
                <div class="mt-5 space-y-4">

                    
                    <?php if($errors->any()): ?>
                        <div class="rounded-lg bg-red-50 border border-red-200 mt-2 p-3 text-sm text-red-600">
                            <ul class="list-disc list-inside space-y-1">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    
                    <form method="POST" action="<?php echo e(route('user.password.update')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        
                        <div>
                            <label class="text-sm text-gray-600">
                                Password Lama
                            </label>
                            <input type="password" name="current_password" value="<?php echo e(old('current_password')); ?>"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                        <?php echo e($errors->has('current_password') ? 'border-red-500' : 'border-gray-300'); ?>">
                        </div>

                        
                        <div>
                            <label class="text-sm text-gray-600">
                                Password Baru
                            </label>
                            <input type="password" name="password" value="<?php echo e(old('password')); ?>"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                        <?php echo e($errors->has('password') ? 'border-red-500' : 'border-gray-300'); ?>">
                        </div>

                        
                        <div>
                            <label class="text-sm text-gray-600">
                                Konfirmasi Password
                            </label>
                            <input type="password" name="password_confirmation"
                                value="<?php echo e(old('password_confirmation')); ?>"
                                class="w-full mt-1 rounded-lg px-3 py-2 border
                        <?php echo e($errors->has('password_confirmation') ? 'border-red-500' : 'border-gray-300'); ?>">
                        </div>

                        
                        <div class="flex justify-end gap-2 pt-4 border-t">
                            <?php if (isset($component)) { $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-button','data' => ['type' => 'button','variant' => 'secondary','xOn:click' => '$dispatch(\'close-modal\', \'change-password\')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'secondary','x-on:click' => '$dispatch(\'close-modal\', \'change-password\')']); ?>
                                Batal
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $attributes = $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $component = $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
<?php endif; ?>

                            <?php if (isset($component)) { $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>
                                Simpan
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $attributes = $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68)): ?>
<?php $component = $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68; ?>
<?php unset($__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68); ?>
<?php endif; ?>
                        </div>

                    </form>
                </div>
            </div>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $attributes = $__attributesOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__attributesOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9f64f32e90b9102968f2bc548315018c)): ?>
<?php $component = $__componentOriginal9f64f32e90b9102968f2bc548315018c; ?>
<?php unset($__componentOriginal9f64f32e90b9102968f2bc548315018c); ?>
<?php endif; ?>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb143a286fba2d785c473946bdb901dc1)): ?>
<?php $attributes = $__attributesOriginalb143a286fba2d785c473946bdb901dc1; ?>
<?php unset($__attributesOriginalb143a286fba2d785c473946bdb901dc1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb143a286fba2d785c473946bdb901dc1)): ?>
<?php $component = $__componentOriginalb143a286fba2d785c473946bdb901dc1; ?>
<?php unset($__componentOriginalb143a286fba2d785c473946bdb901dc1); ?>
<?php endif; ?>
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/user/profile_index.blade.php ENDPATH**/ ?>