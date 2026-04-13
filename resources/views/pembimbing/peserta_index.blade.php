<x-apppembimbing-layout>

    {{-- HEADER --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            Daftar Peserta
        </h2>
    </x-slot>

    <x-card>

        <div class="mb-4 text-sm text-gray-600">
            Total Peserta :
            <span class="font-semibold text-gray-800">
                {{ $peserta->count() }}
            </span>
        </div>


        {{-- DESKTOP TABLE --}}
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 border-b">
                    <tr class="text-gray-600 text-sm">
                        <th class="px-4 py-3 text-left">Peserta</th>
                        <th class="px-4 py-3 text-left">Bagian</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Hadir</th>
                        <th class="px-4 py-3 text-center">Alpha</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($peserta as $user)
                        <tr class="hover:bg-gray-50">

                            <td class="px-4 py-3 flex items-center gap-3">
                                <div
                                    class="w-12 h-12 rounded-full overflow-hidden border border-blue-100 shadow 
                                    flex items-center justify-center bg-blue-100">

                                    @if ($user->foto)
                                        <img src="{{ asset('storage/' . $user->foto) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <x-heroicon-o-user class="w-6 h-6 text-white" />
                                    @endif

                                </div>
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                                </div>
                            </td>

                            <td class="px-4 py-3 text-left">
                                {{ $user->profile?->bagian?->nama ?? '-' }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $user->profile?->status_magang === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                    {{ $user->profile?->status_magang ?? '-' }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center font-semibold text-green-600">
                                {{ $user->total_hadir }}
                            </td>

                            <td class="px-4 py-3 text-center font-semibold text-red-600">
                                {{ $user->total_alpha }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <a href="{{ route('pembimbing.peserta.show', $user->id) }}"
                                    class="text-blue-600 hover:underline underline text-sm font-semibold">
                                    Detail
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-gray-500">
                                Belum ada peserta bimbingan
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>



        {{-- MOBILE CARD --}}
        <div class="lg:hidden space-y-4">

            @forelse($peserta as $user)
                <div class="border rounded-xl p-4 shadow-sm bg-white">

                    {{-- Header --}}
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ $user->foto ? asset('storage/' . $user->foto) : asset('default-user.png') }}"
                            class="w-12 h-12 rounded-full object-cover">

                        <div>
                            <p class="font-semibold text-gray-800">
                                {{ $user->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="grid grid-cols-2 gap-3 text-xs mb-3">

                        <div>
                            <p class="text-gray-400 text-xs">Bagian</p>
                            <p class="font-medium">
                                {{ $user->profile?->bagian?->nama ?? '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-xs mb-1">Status</p>
                            <span
                                class="px-2 py-1 rounded-full text-xs font-semibold
                                {{ $user->profile?->status_magang === 'Aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-600' }}">
                                {{ $user->profile?->status_magang ?? '-' }}
                            </span>
                        </div>

                        <div>
                            <p class="text-gray-400 text-xs">Hadir</p>
                            <p class="font-semibold text-green-600">
                                {{ $user->total_hadir }}
                            </p>
                        </div>

                        <div>
                            <p class="text-gray-400 text-xs">Alpha</p>
                            <p class="font-semibold text-red-600">
                                {{ $user->total_alpha }}
                            </p>
                        </div>

                    </div>

                    {{-- Aksi --}}
                    <a href="{{ route('pembimbing.peserta.show', $user->id) }}"
                        class="block text-center bg-blue-600 text-white py-2 rounded-lg text-xs font-semibold">
                        Lihat Detail
                    </a>

                </div>

            @empty
                <div class="text-center py-8 text-gray-500">
                    Belum ada peserta bimbingan
                </div>
            @endforelse

        </div>

    </x-card>

</x-apppembimbing-layout>
