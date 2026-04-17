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
        <span class="font-semibold text-[#0D1B2A]">
            Laporan Presensi
        </span>
     <?php $__env->endSlot(); ?>

    
    <?php if (isset($component)) { $__componentOriginal89a0ab30eb799a5cb909bca47f9344d2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89a0ab30eb799a5cb909bca47f9344d2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-toast','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-toast'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89a0ab30eb799a5cb909bca47f9344d2)): ?>
<?php $attributes = $__attributesOriginal89a0ab30eb799a5cb909bca47f9344d2; ?>
<?php unset($__attributesOriginal89a0ab30eb799a5cb909bca47f9344d2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89a0ab30eb799a5cb909bca47f9344d2)): ?>
<?php $component = $__componentOriginal89a0ab30eb799a5cb909bca47f9344d2; ?>
<?php unset($__componentOriginal89a0ab30eb799a5cb909bca47f9344d2); ?>
<?php endif; ?>
    <?php if(session('success')): ?>
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(new CustomEvent('user-toast', {
                    detail: {
                        title: 'Berhasil',
                        message: <?php echo json_encode(session('success'), 15, 512) ?>
                    }
                }));
            });
        </script>
    <?php endif; ?>


    <?php if(session('error')): ?>
        <script>
            window.addEventListener('load', () => {
                window.dispatchEvent(new CustomEvent('user-toast', {
                    detail: {
                        title: 'Gagal',
                        message: <?php echo json_encode(session('error'), 15, 512) ?>
                    }
                }));
            });
        </script>
    <?php endif; ?>
    <?php if(session('download_file')): ?>
        <script>
            window.addEventListener('load', () => {
                window.location.href = "<?php echo e(asset('storage/' . session('download_file'))); ?>";
            });
        </script>
    <?php endif; ?>

    <iframe name="downloadFrame" style="display:none;"></iframe>

    <div x-data="{ openExport: false }">

        <?php
            $hadir = $presensi->where('status', 'hadir')->where('is_late', false)->count();
            $pending = $presensi->where('status', 'pending')->count();
            $telat = $presensi->where('status', 'hadir')->where('is_late', true)->count();
            $sakit = $presensi->where('status', 'sakit')->count();
            $izin = $presensi->where('status', 'izin')->count();
            $alpha = $presensi->where('status', 'alpha')->count();
        ?>

        
        <div class="hidden md:grid grid-cols-5 gap-4 mb-4">
            <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'text-center']); ?>
                <p class="text-sm text-gray-500">Hadir</p>
                <p class="text-2xl font-bold text-green-600"><?php echo e($hadir); ?></p>
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
<?php $component->withAttributes(['class' => 'text-center']); ?>
                <p class="text-sm text-gray-500">Telat</p>
                <p class="text-2xl font-bold text-yellow-600"><?php echo e($telat); ?></p>
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
<?php $component->withAttributes(['class' => 'text-center']); ?>
                <p class="text-sm text-gray-500">Sakit</p>
                <p class="text-2xl font-bold text-purple-600"><?php echo e($sakit); ?></p>
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
<?php $component->withAttributes(['class' => 'text-center']); ?>
                <p class="text-sm text-gray-500">Izin</p>
                <p class="text-2xl font-bold text-blue-600"><?php echo e($izin); ?></p>
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
<?php $component->withAttributes(['class' => 'text-center']); ?>
                <p class="text-sm text-gray-500">Alpha</p>
                <p class="text-2xl font-bold text-red-600"><?php echo e($alpha); ?></p>
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

        
        <?php if (isset($component)) { $__componentOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal740c66ff9bbfcb19a96a45ba2fa42d64 = $attributes; } ?>
<?php $component = App\View\Components\Card::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Card::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'md:hidden px-2 py-3 mb-6']); ?>

            <?php
                $rekapMobile = [
                    'Hadir' => $hadir,
                    'Pending' => $pending,
                    'Telat' => $telat,
                    'Sakit' => $sakit,
                    'Izin' => $izin,
                    'Alpha' => $alpha,
                ];
            ?>

            <div class="flex text-xs font-semibold text-center divide-x">
                <?php $__currentLoopData = $rekapMobile; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex-1">
                        <p class="text-gray-400"><?php echo e($label); ?></p>
                        <p class="text-[#123B6E] text-sm font-bold">
                            <?php echo e($value); ?>

                        </p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $component->withAttributes(['class' => 'p-0 overflow-hidden mb-6']); ?>

            
            <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                
                <div class="flex items-center gap-2 text-[#123B6E] font-semibold text-lg">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-clipboard-document-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
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
                    <span>Riwayat Presensi</span>
                </div>

                
                <div class="flex gap-3 w-full md:w-auto">

                    
                    <form method="GET" class="w-1/2 md:w-40">
                        <?php if (isset($component)) { $__componentOriginal053268fbfbcaf25408d135dd7fa91344 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal053268fbfbcaf25408d135dd7fa91344 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.select-box','data' => ['name' => 'sort','value' => request('sort', 'desc'),'options' => [
                            'desc' => 'Terbaru',
                            'asc' => 'Terlama',
                        ],'placeholder' => 'Urutkan','submit' => 'true']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('select-box'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'sort','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request('sort', 'desc')),'options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
                            'desc' => 'Terbaru',
                            'asc' => 'Terlama',
                        ]),'placeholder' => 'Urutkan','submit' => 'true']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal053268fbfbcaf25408d135dd7fa91344)): ?>
<?php $attributes = $__attributesOriginal053268fbfbcaf25408d135dd7fa91344; ?>
<?php unset($__attributesOriginal053268fbfbcaf25408d135dd7fa91344); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal053268fbfbcaf25408d135dd7fa91344)): ?>
<?php $component = $__componentOriginal053268fbfbcaf25408d135dd7fa91344; ?>
<?php unset($__componentOriginal053268fbfbcaf25408d135dd7fa91344); ?>
<?php endif; ?>
                    </form>

                    
                    <?php if (isset($component)) { $__componentOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald5f599ea2bb9ab3eb0cde645c20a5f68 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.user-button','data' => ['icon' => 'heroicon-o-arrow-down-tray','xOn:click' => '$dispatch(\'open-modal\', \'export-presensi\')','class' => 'w-1/2 md:w-auto justify-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('user-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'heroicon-o-arrow-down-tray','x-on:click' => '$dispatch(\'open-modal\', \'export-presensi\')','class' => 'w-1/2 md:w-auto justify-center']); ?>
                        Export
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

            </div>

            <div class="mt-6">

                
                <div class="md:hidden space-y-3 pb-3">

                    <?php $__empty_1 = true; $__currentLoopData = $presensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $displayStatus = $item->status === 'hadir' && $item->is_late ? 'telat' : $item->status;

                            $statusMap = [
                                'hadir' => 'text-green-600',
                                'pending' => 'text-gray-500 italic',
                                'telat' => 'text-yellow-600',
                                'izin' => 'text-blue-600',
                                'sakit' => 'text-purple-600',
                                'alpha' => 'text-red-600',
                            ];

                            $statusLabel = [
                                'hadir' => 'Hadir',
                                'pending' => 'Pending',
                                'telat' => 'Telat',
                                'izin' => 'Izin',
                                'sakit' => 'Sakit',
                                'alpha' => 'Alpha',
                            ];

                            $jamMasuk = $item->jam_masuk ?? '-';
                            $jamKeluar = $item->jam_keluar ?? '-';
                        ?>

                        <div class="bg-white border border-gray-200 rounded-2xl p-3 shadow-sm" x-data="{ open: false }">

                            
                            <div class="flex justify-between items-center">

                                <div class="flex items-center gap-1.5">

                                    <div class="text-sm font-semibold text-gray-800">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d M Y')); ?>

                                    </div>

                                    <span class="ml-2 text-sm <?php echo e($statusMap[$displayStatus] ?? 'text-gray-400'); ?>">

                                        <?php echo e($statusLabel[$displayStatus] ?? 'Pending'); ?>


                                        <?php if($displayStatus === 'telat' && $item->late_minutes): ?>
                                            <span class="ml-1 text-[11px]">
                                                (<?php echo e($item->late_minutes); ?> menit)
                                            </span>
                                        <?php endif; ?>

                                    </span>

                                </div>

                                
                                <button type="button" @click="open = !open"
                                    class="text-xs text-[#123B6E] hover:underline">
                                    <span x-show="!open">Detail</span>
                                    <span x-show="open">Tutup</span>
                                </button>

                            </div>

                            
                            <div x-show="open" x-transition class="mt-1 text-xs text-gray-700">

                                
                                <div class="border-t mb-1"></div>
                                <div>
                                    <div class="text-gray-800 font-semibold  py-1">
                                        <?php echo e($jamMasuk); ?> - <?php echo e($jamKeluar); ?>

                                    </div>
                                </div>
                                
                                <div>
                                    <div class="text-gray-500 py-1">
                                        Catatan Kegiatan:
                                    </div>
                                    <div class="-mt-5 text-gray-800 whitespace-pre-line">
                                        <?php echo e($item->keterangan ?? '-'); ?>

                                    </div>
                                </div>

                                
                                <div class="border-t mt-1"></div>

                                
                                <div class="flex justify-between py-1">
                                    <span class="text-gray-500">Sumber</span>
                                    <span class="text-gray-800 font-medium">
                                        <?php if(in_array($item->status, ['izin', 'sakit'])): ?>
                                            <?php echo e($item->pengajuan_id ? 'Pengajuan' : 'Manual'); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </span>
                                </div>

                                
                                <div class="flex justify-between py-1">
                                    <span class="text-gray-500">Diubah</span>

                                    <?php if($item->updated_at && $item->updated_at != $item->created_at): ?>
                                        <div class="text-right leading-tight">

                                            
                                            <div class="text-gray-800 font-medium">
                                                <?php echo e(\Carbon\Carbon::parse($item->updated_at)->format('d/m/y H:i')); ?>

                                            </div>

                                            
                                            <?php if($item->updatedBy): ?>
                                                <span class="text-[10px] text-gray-500 italic">
                                                    oleh <?php echo e($item->updatedBy->name); ?>

                                                </span>
                                            <?php endif; ?>

                                        </div>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center text-gray-500 py-10">
                            Belum ada data presensi
                        </div>
                    <?php endif; ?>

                </div>

                
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-sm border-collapse table-fixed">
                        <thead class="bg-gray-100">
                            <tr class="text-xs uppercase tracking-wide text-gray-500 border-b text-center">
                                <th class="px-4 py-3 w-12">No</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Sumber</th>
                                <th class="px-4 py-3">Masuk</th>
                                <th class="px-4 py-3">Keluar</th>
                                <th class="px-4 py-3 text-left w-[400px]">Catatan</th>
                                <th class="px-4 py-3">Diubah</th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $presensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php
                                    $displayStatus =
                                        $item->status === 'hadir' && $item->is_late ? 'telat' : $item->status;
                                ?>
                                <tr class="border-b hover:bg-gray-50 text-center">
                                    <td class="px-4 py-4">
                                        <?php echo e(($presensi->currentPage() - 1) * $presensi->perPage() + $loop->iteration); ?>

                                    </td>
                                    <td class="px-4 py-4 text-left whitespace-nowrap">
                                        <?php echo e(\Carbon\Carbon::parse($item->tanggal)->format('d M Y')); ?>

                                    </td>

                                    <td class="px-4 py-4 text-center">
                                        <?php if($displayStatus === 'telat' && $item->late_minutes): ?>
                                            <div class="flex flex-col items-center leading-tight">
                                                <span
                                                    class="px-3 py-1 rounded-full text-xs font-semibold <?php echo e($statusMap[$displayStatus]); ?>">
                                                    <?php echo e($statusLabel[$displayStatus]); ?>

                                                </span>
                                                <span class="text-[10px] text-gray-500 mt-1">
                                                    +<?php echo e($item->late_minutes); ?> menit
                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span
                                                class="px-3 rounded-full text-xs font-semibold
                                                <?php echo e($statusMap[$displayStatus] ?? 'text-gray-600'); ?>">
                                                <?php echo e($statusLabel[$displayStatus] ?? '-'); ?>

                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-4 py-4">
                                        <?php if(in_array($item->status, ['izin', 'sakit'])): ?>
                                            <?php echo e($item->pengajuan_id ? 'Pengajuan' : 'Manual'); ?>

                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>

                                    <td class="px-4 py-4"><?php echo e($item->jam_masuk ?? '-'); ?></td>
                                    <td class="px-4 py-4"><?php echo e($item->jam_keluar ?? '-'); ?></td>

                                    <td class="px-4 py-4 text-left align-top">

                                        <?php
                                            $keterangan = $item->keterangan ?? '-';
                                        ?>

                                        <div x-data="{ open: false }" class="max-w-[400px]">

                                            
                                            <div x-show="!open" class="flex items-start gap-2">

                                                <span class="truncate flex-1 text-gray-700">
                                                    <?php echo e($keterangan); ?>

                                                </span>

                                                <?php if(strlen($keterangan) > 60): ?>
                                                    <button type="button" @click="open = true"
                                                        class="text-xs text-[#123B6E] hover:underline whitespace-nowrap">
                                                        Detail
                                                    </button>
                                                <?php endif; ?>

                                            </div>

                                            
                                            <div x-show="open" x-transition class="space-y-1">

                                                <div class="flex items-start gap-2">

                                                    <span class="flex-1 whitespace-pre-line text-gray-700">
                                                        <?php echo e($keterangan); ?>

                                                    </span>

                                                    <button type="button" @click="open = false"
                                                        class="text-xs text-[#123B6E] hover:underline whitespace-nowrap">
                                                        Tutup
                                                    </button>

                                                </div>

                                            </div>

                                        </div>

                                    </td>
                                    <td class="px-4 py-4 text-xs">
                                        <?php if($item->updated_at && $item->updated_at != $item->created_at): ?>
                                            <div class="flex flex-col items-center leading-tight">

                                                
                                                <span>
                                                    <?php echo e(\Carbon\Carbon::parse($item->updated_at)->format('d/m/y H:i')); ?>

                                                </span>

                                                
                                                <?php if($item->updatedBy): ?>
                                                    <span class="text-[10px] text-gray-500 italic">
                                                        oleh <?php echo e($item->updatedBy->name); ?>

                                                    </span>
                                                <?php else: ?>
                                                    <?php if($item->updatedBy): ?>
                                                        <span class="text-[10px] text-gray-500 italic">
                                                            oleh <?php echo e($item->updatedBy->name); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </div>
                                        <?php else: ?>
                                            -
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="8" class="py-16 text-center text-gray-500">
                                        Belum ada data presensi
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end mt-6">
                <?php echo e($presensi->onEachSide(1)->links()); ?>

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

        <?php if (isset($component)) { $__componentOriginal9f64f32e90b9102968f2bc548315018c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9f64f32e90b9102968f2bc548315018c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.modal','data' => ['name' => 'export-presensi','maxWidth' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'export-presensi','maxWidth' => 'md']); ?>
            <div class="p-6" x-data="{ mode: 'all', from: '', to: '', error: '' }">
                <h2 class="text-lg font-semibold mb-5 text-[#123B6E]">
                    Export Laporan Presensi
                </h2>
                
                <div class="space-y-3 mb-5">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="radio" value="all" x-model="mode"
                            class="text-[#123B6E] focus:ring-[#123B6E]">
                        <span class="text-sm font-medium">
                            Export Semua Data
                        </span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="radio" value="range" x-model="mode"
                            class="text-[#123B6E] focus:ring-[#123B6E]">
                        <span class="text-sm font-medium">
                            Export Berdasarkan Rentang Tanggal
                        </span>
                    </label>
                </div>
                <form method="GET" action="<?php echo e(route('user.laporan.export')); ?>" class="space-y-4"
                    x-data="{
                        validate() {
                                if (this.from && this.to && this.to < this.from) {
                                    this.error = 'Tanggal selesai tidak boleh sebelum tanggal mulai';
                                } else {
                                    this.error = '';
                                }
                            },
                            get isInvalid() {
                                if (mode === 'range') {
                                    return !this.from || !this.to || this.error !== '';
                                }
                                return false;
                            }
                    }">

                    
                    <div x-show="mode === 'range'" x-transition class="space-y-4">

                        <div>
                            <label class="text-sm font-medium text-gray-600">
                                Dari Tanggal*
                            </label>
                            <input type="date" name="from" x-model="from"
                                :max="new Date().toISOString().split('T')[0]" @change="validate()"
                                class="w-full mt-1 border rounded-lg px-3 py-2">
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-600">
                                Sampai Tanggal*
                            </label>
                            <input type="date" name="to" x-model="to" :min="from"
                                :max="new Date().toISOString().split('T')[0]" @change="validate()"
                                class="w-full mt-1 border rounded-lg px-3 py-2">
                        </div>

                        <div x-show="error">
                            <?php if (isset($component)) { $__componentOriginal9b1df53224e42948610ceb30d6d57a7c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b1df53224e42948610ceb30d6d57a7c = $attributes; } ?>
<?php $component = App\View\Components\AlertError::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('alert-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AlertError::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                                <span x-text="error"></span>
                             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b1df53224e42948610ceb30d6d57a7c)): ?>
<?php $attributes = $__attributesOriginal9b1df53224e42948610ceb30d6d57a7c; ?>
<?php unset($__attributesOriginal9b1df53224e42948610ceb30d6d57a7c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b1df53224e42948610ceb30d6d57a7c)): ?>
<?php $component = $__componentOriginal9b1df53224e42948610ceb30d6d57a7c; ?>
<?php unset($__componentOriginal9b1df53224e42948610ceb30d6d57a7c); ?>
<?php endif; ?>
                        </div>

                    </div>

                    
                    <div class="flex justify-end gap-3 pt-4 border-t">

                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'button','variant' => 'secondary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-on:click' => '$dispatch(\'close-modal\', \'export-presensi\')']); ?>
                            Batal
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>

                        <?php if (isset($component)) { $__componentOriginale67687e3e4e61f963b25a6bcf3983629 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale67687e3e4e61f963b25a6bcf3983629 = $attributes; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'submit','variant' => 'primary'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Button::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-bind:disabled' => 'isInvalid','x-bind:class' => 'isInvalid ? \'opacity-50 cursor-not-allowed\' : \'\'','@click' => '
                                if(!error){
                                    $dispatch(\'close-modal\', \'export-presensi\');
                                    window.dispatchEvent(new CustomEvent(\'user-toast\', {
                                        detail: {
                                            title: \'Berhasil\',
                                            message: \'Laporan sedang diunduh\'
                                        }
                                    }));
                                }
                            ']); ?>
                            Download PDF
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $attributes = $__attributesOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__attributesOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale67687e3e4e61f963b25a6bcf3983629)): ?>
<?php $component = $__componentOriginale67687e3e4e61f963b25a6bcf3983629; ?>
<?php unset($__componentOriginale67687e3e4e61f963b25a6bcf3983629); ?>
<?php endif; ?>

                    </div>

                </form>

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
<?php /**PATH C:\Users\Lenovo\Downloads\presma\resources\views/user/laporan.blade.php ENDPATH**/ ?>