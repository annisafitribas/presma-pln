<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $appName }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Favicon --}}
    @if (!empty($appLogo))
        <link rel="icon" type="image/png" href="{{ asset('storage/' . $appLogo) }}">
    @else
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        @keyframes bigPing {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            70% {
                transform: scale(5);
                opacity: 0;
            }

            100% {
                opacity: 0;
            }
        }

        .big-ping {
            animation: bigPing 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
        }
    </style>
</head>

@php
    $fotoTopbar = auth()->user()->foto ? asset('storage/' . auth()->user()->foto) : asset('default-user.png');
@endphp

@php
    $fullName = auth()->user()->name;

    $nameParts = preg_split('/\s+/', trim($fullName));

    $shortName = count($nameParts) > 1 ? $nameParts[0] . ' ' . $nameParts[1] : $fullName;
@endphp

<body x-data class="font-sans antialiased bg-[#F5F7FA] text-gray-800">
    <div class="min-h-screen flex">

        <!-- SIDEBAR -->
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40
               w-64 bg-[#0D1B2A] text-[#E0E6ED]
               border-r border-[#1B263B]
               transition-all duration-300 ease-in-out
               -translate-x-full md:translate-x-0">

            <div class="h-full flex flex-col px-4 overflow-y-auto">

                <div class="flex items-center gap-3 py-6 px-3">
                    <div id="logoWrapper"
                        class="transition-all duration-300
                    w-11 h-11
                    rounded-xl flex items-center justify-center overflow-hidden">

                        @if (!empty($appLogo) && file_exists(public_path('storage/' . $appLogo)))
                            <img src="{{ asset('storage/' . $appLogo) }}" class="w-full h-full object-contain"
                                alt="Logo">
                        @else
                            <x-heroicon-o-building-office class="w-7 h-7 text-white" />
                        @endif
                    </div>

                    <span class="text-lg font-semibold sidebar-text">
                        {{ $appName }}
                    </span>
                </div>

                <!-- MENU -->
                @php
                    $menu = [
                        ['Dashboard', 'admin.dashboard', 'heroicon-o-squares-2x2'],
                        ['Konfigurasi', 'admin.konfigurasi.index', 'heroicon-o-building-office'],
                        ['bidang', 'admin.bidang.index', 'heroicon-o-rectangle-stack'],
                        ['Pengguna', 'admin.pengguna.index', 'heroicon-o-users'],
                        ['Presensi Harian', 'admin.presensi.harian', 'heroicon-o-calendar-days'],
                        ['Riwayat Presensi', 'admin.presensi.index', 'heroicon-o-archive-box'],
                        ['Daftar Telat', 'admin.telat.index', 'heroicon-o-clock'],
                        ['Daftar Pengajuan', 'admin.pengajuan.index', 'heroicon-o-document-check'],
                    ];
                @endphp

                <ul class="space-y-2 mt-2">

                    {{-- MENU UTAMA --}}
                    @foreach ($menu as [$label, $route, $icon])
                        <li>
                            <a href="{{ route($route) }}"
                                class="flex items-center justify-between px-3 py-2 rounded-xl
                                transition hover:bg-white/10
                                {{ request()->routeIs($route . '*') ? 'bg-white text-[#0D1B2A]' : '' }}">

                                <div class="flex items-center gap-3">
                                    <x-dynamic-component :component="$icon" class="w-5 h-5 shrink-0" />
                                    <span class="sidebar-text pr-2">{{ $label }}</span>
                                </div>

                                @if ($route === 'admin.telat.index' && ($notifTelat ?? 0) > 0)
                                    <span class="relative flex items-center">
                                        <span class="absolute inline-flex h-2 w-2 rounded-full bg-red-500 big-ping">
                                        </span>

                                        <span
                                            class="relative inline-flex items-center justify-center 
                                            min-w-[20px] h-5 px-1.5 text-[11px]
                                            rounded-full bg-red-500 text-white font-semibold">
                                            {{ $notifTelat }}
                                        </span>
                                    </span>
                                @endif

                                @if ($route === 'admin.pengajuan.index' && ($notifPengajuan ?? 0) > 0)
                                    <span class="relative flex items-center">
                                        <span class="absolute inline-flex h-2 w-2 rounded-full bg-red-500 big-ping">
                                        </span>

                                        <span
                                            class="relative inline-flex items-center justify-center 
                                            min-w-[20px] h-5 px-1.5 text-[11px]
                                            rounded-full bg-orange-500 text-white font-semibold">
                                            {{ $notifPengajuan }}
                                        </span>
                                    </span>
                                @endif
                            </a>
                        </li>
                    @endforeach


                    {{-- GARIS PEMISAH --}}
                    <li class="my-3">
                        <div class="h-px bg-white/20"></div>
                    </li>

                    {{-- PROFIL ADMIN --}}
                    <li>
                        <a href="{{ route('admin.profile.show') }}"
                            class="flex items-center gap-3 px-3 py-2 rounded-xl
                            transition hover:bg-white/10
                            {{ request()->routeIs('admin.profile*') ? 'bg-white text-[#0D1B2A]' : '' }}">
                            <x-heroicon-o-user-circle class="w-5 h-5 shrink-0" />
                            <span class="sidebar-text">Profil</span>
                        </a>
                    </li>

                    {{-- LOGOUT --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-3 px-3 py-2 rounded-xl
                                text-red-400 hover:bg-red-500/10 transition">
                                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 shrink-0" />
                                <span class="sidebar-text">Keluar</span>
                            </button>
                        </form>
                    </li>
                </ul>

            </div>
        </aside>

        <!-- OVERLAY MOBILE -->
        <div id="overlay" class="fixed inset-0 bg-black/50 hidden z-30 md:hidden"></div>

        <!-- MAIN -->
        <div id="main" class="flex-1 flex flex-col transition-all duration-300 md:ml-64">

            <!-- TOPBAR -->
            <nav
                class="sticky top-0 z-20 bg-white/80 backdrop-blur
                   border-b shadow-sm px-4 py-3 flex items-center gap-3">

                <!-- TOGGLE (SAMA UNTUK DESKTOP & MOBILE) -->
                <button id="toggle" class="p-2 rounded-lg hover:bg-gray-100 transition">
                    <x-heroicon-o-bars-3 class="w-6 h-6" />
                </button>

                <h1 class="text-lg font-semibold">
                    {{ $header ?? 'Dashboard Admin' }}
                </h1>

                <!-- USER -->
                <div class="ml-auto pr-4">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center gap-2 focus:outline-none">
                                <div
                                    class="w-9 h-9 rounded-full overflow-hidden border shadow bg-gray-100 flex items-center justify-center">
                                    @if (!empty(auth()->user()->foto) && file_exists(public_path('storage/' . auth()->user()->foto)))
                                        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                                            alt="Foto {{ auth()->user()->name }}" class="w-full h-full object-cover">
                                    @else
                                        <x-heroicon-o-user class="w-5 h-5 text-gray-500" />
                                    @endif
                                </div>

                                {{-- NAMA (DESKTOP ONLY) --}}
                                <span class="hidden md:block font-semibold text-sm text-gray-700">
                                    {{ $shortName }}
                                </span>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b">
                                <p class="font-semibold">{{ $shortName }}</p>
                            </div>

                            {{-- PROFIL --}}
                            <x-dropdown-link href="{{ route('admin.profile.show') }}">
                                <div class="flex items-center gap-2">
                                    <x-heroicon-o-user-circle class="w-4 h-4" />
                                    <span>Profil</span>
                                </div>
                            </x-dropdown-link>

                            {{-- LOGOUT --}}
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600">
                                    <div class="flex items-center gap-2">
                                        <x-heroicon-o-arrow-left-on-rectangle class="w-4 h-4" />
                                        <span>Keluar</span>
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </x-slot>

                    </x-dropdown>
                </div>
            </nav>

            <!-- CONTENT -->
            <main class="p-6">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main');
        const overlay = document.getElementById('overlay');
        const toggle = document.getElementById('toggle');

        let collapsed = localStorage.getItem('sidebar') === 'collapsed';

        function desktopState() {
            if (collapsed) {
                sidebar.classList.replace('w-64', 'w-20');
                main.classList.replace('md:ml-64', 'md:ml-20');
                document.querySelectorAll('.sidebar-text')
                    .forEach(el => el.classList.add('hidden'));
            } else {
                sidebar.classList.replace('w-20', 'w-64');
                main.classList.replace('md:ml-20', 'md:ml-64');
                document.querySelectorAll('.sidebar-text')
                    .forEach(el => el.classList.remove('hidden'));
            }
        }

        document.querySelectorAll('#sidebar a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth >= 768 && collapsed) {
                    collapsed = false;
                    localStorage.setItem('sidebar', 'expanded');
                    desktopState();
                }
            });
        });

        toggle.addEventListener('click', () => {
            if (window.innerWidth >= 768) {
                collapsed = !collapsed;
                localStorage.setItem('sidebar', collapsed ? 'collapsed' : 'expanded');
                desktopState();
            } else {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        if (window.innerWidth >= 768) {
            desktopState();
        }
    </script>
    <x-toast />
</body>

</html>
