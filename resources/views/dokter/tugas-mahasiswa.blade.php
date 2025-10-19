<x-layout-dokter>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div x-data="{}" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-8 py-6">

        {{-- ===== Toolbar: Search + Meta ===== --}}
        <div class="mb-5 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <p class="text-sm text-slate-500">Total: <span class="font-medium">{{ $dataTugas->total() }}</span>
                    tugas</p>
            </div>

            <form action="#" method="GET" class="relative w-full sm:w-96">
                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-500"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="m21 21-3.5-3.5" />
                    <circle cx="10" cy="10" r="7" />
                </svg>
                <input id="search" name="search" value="{{ request('search') }}" autocomplete="off"
                    placeholder="Cari tugas atau nama mahasiswa…"
                    class="w-full rounded-xl border border-slate-300 bg-white pl-10 pr-3 py-2.5 text-sm text-slate-900
                 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    type="text" />
                @if (request('search'))
                    <a href="{{ url()->current() }}"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-xs px-2 py-1 rounded-md bg-slate-100 text-slate-600 hover:bg-slate-200">
                        Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- ===== DESKTOP: Table ===== --}}
        <div class="hidden md:block">
            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full text-sm">
                    <thead class="sticky top-0 bg-slate-50 text-slate-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center w-16">No</th>
                            <th class="px-4 py-3 text-left">Nama Tugas</th>
                            <th class="px-4 py-3 text-left">Nama Mahasiswa</th>
                            <th class="px-4 py-3 text-center w-64">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php $no = $dataTugas->firstItem(); @endphp

                        @forelse ($dataTugas as $tugas)
                            @if ($tugas->mahasiswa->count())
                                @foreach ($tugas->mahasiswa as $mahasiswa)
                                    <tr class="odd:bg-white even:bg-slate-50 hover:bg-slate-50">
                                        <td class="px-4 py-3 text-center">{{ $no++ }}</td>
                                        <td class="px-4 py-3 font-medium text-slate-900">{{ $tugas->nama_tugas }}</td>
                                        <td class="px-4 py-3">{{ $mahasiswa->nama_mahasiswa ?? 'Tidak ada' }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ route('dokter.project.mahasiswa', ['mahasiswa' => $mahasiswa->slug, 'tugas' => $tugas->slug]) }}"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-amber-600 px-3 py-2 text-white hover:bg-amber-700 focus:ring-4 focus:ring-amber-300">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="m21 21-6-6" />
                                                        <circle cx="11" cy="11" r="8" />
                                                    </svg>
                                                    Detail Tugas
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd:bg-white even:bg-slate-50">
                                    <td class="px-4 py-3 text-center">{{ $no++ }}</td>
                                    <td class="px-4 py-3 font-medium text-slate-900">{{ $tugas->nama_tugas }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-600 ring-1 ring-red-200">
                                            Belum ada mahasiswa
                                        </span>
                                    </td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-12 text-center text-slate-500">
                                    Data masih kosong. Coba ubah pencarianmu… atau ambil napas dulu, baru coba lagi 😄
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $dataTugas->links() }}
            </div>
        </div>

        {{-- ===== MOBILE: Cards ===== --}}
        <div class="md:hidden space-y-3">
            @php $noMobile = $dataTugas->firstItem(); @endphp

            @forelse ($dataTugas as $tugas)
                @if ($tugas->mahasiswa->count())
                    @foreach ($tugas->mahasiswa as $mahasiswa)
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div>
                                    <p class="text-xs text-slate-500">#{{ $noMobile++ }}</p>
                                    <h3 class="mt-1 text-base font-semibold text-slate-900">{{ $tugas->nama_tugas }}
                                    </h3>
                                    <p class="mt-1 text-sm text-slate-600">Mahasiswa: <span
                                            class="font-medium">{{ $mahasiswa->nama_mahasiswa ?? 'Tidak ada' }}</span>
                                    </p>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('dokter.project.mahasiswa', ['mahasiswa' => $mahasiswa->slug, 'tugas' => $tugas->slug]) }}"
                                    class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-amber-600 px-3 py-2 text-sm font-medium text-white hover:bg-amber-700">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="m21 21-6-6" />
                                        <circle cx="11" cy="11" r="8" />
                                    </svg>
                                    Detail Tugas
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                        <div class="flex items-start justify-between">
                            <div>
                                <p class="text-xs text-slate-500">#{{ $noMobile++ }}</p>
                                <h3 class="mt-1 text-base font-semibold text-slate-900">{{ $tugas->nama_tugas }}</h3>
                                <p class="mt-1 text-sm">
                                    <span
                                        class="inline-flex items-center gap-2 rounded-full bg-red-50 px-3 py-1 text-xs font-medium text-red-600 ring-1 ring-red-200">
                                        Belum ada mahasiswa
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center text-slate-500">
                    Data masih kosong. Santai—itu bukan salahmu (mungkin) 😅
                </div>
            @endforelse

            <div class="mt-4">
                {{ $dataTugas->links() }}
            </div>
        </div>

    </div>
</x-layout-dokter>
