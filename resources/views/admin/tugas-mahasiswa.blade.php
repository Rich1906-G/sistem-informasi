<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-2 py-6">
        {{-- Header card: title + search --}}
        <div
            class="bg-white dark:bg-gray-800/80 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700 rounded-xl p-4 mb-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Daftar Tugas & Mahasiswa</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Pantau mahasiswa yang ter-assign ke setiap
                        tugas.</p>
                </div>

                <form action="#" method="GET" class="w-full md:w-auto">
                    <div class="flex gap-2">
                        <div class="relative flex-1 md:w-80">
                            <label for="search" class="sr-only">Cari data</label>
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                            </span>
                            <input id="search" name="search" autocomplete="off"
                                class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700/70
                            pl-10 pr-3 py-2 text-sm text-slate-800 dark:text-slate-100
                            placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                type="text" placeholder="Cari data…">
                        </div>
                        <button type="submit"
                            class="inline-flex items-center justify-center rounded-lg px-4 py-2 text-sm font-medium
                           text-white bg-blue-600 hover:bg-blue-700 focus-visible:ring-2 focus-visible:ring-blue-500">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- MOBILE CARDS ( < md ) --}}
        <div class="md:hidden space-y-3">
            @php $no = $dataTugas->firstItem(); @endphp

            @forelse ($dataTugas as $tugas)
                @if ($tugas->mahasiswa->count() > 0)
                    @foreach ($tugas->mahasiswa as $mahasiswa)
                        <div
                            class="rounded-xl bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700 overflow-hidden">
                            <div class="flex items-start gap-3 p-4">
                                <span
                                    class="inline-flex shrink-0 h-7 min-w-[1.75rem] items-center justify-center rounded-md
                             bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-xs font-semibold">
                                    {{ $no++ }}
                                </span>
                                <div class="min-w-0">
                                    <p class="text-[13px] uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                        Nama Tugas</p>
                                    <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 truncate">
                                        {{ $tugas->nama_tugas }}
                                    </h3>

                                    <div class="mt-3">
                                        <p
                                            class="text-[13px] uppercase tracking-wide text-slate-500 dark:text-slate-400">
                                            Mahasiswa</p>
                                        <p class="text-sm font-medium text-slate-800 dark:text-slate-100">
                                            {{ $mahasiswa->nama_mahasiswa ?? 'Tidak ada' }}
                                        </p>
                                    </div>

                                    <div class="mt-4">
                                        <a href="{{ route('admin.project.mahasiswa', ['mahasiswa' => $mahasiswa->slug, 'tugas' => $tugas->slug]) }}"
                                            class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white
                              px-4 py-2 text-sm focus-visible:ring-2 focus-visible:ring-amber-400">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M19.8 21.6 13.3 15.1c-.9.7-2.1 1.1-3.4 1.1A6 6 0 1 1 16 10c0 1.2-.4 2.4-1.1 3.4l6.5 6.5-1.6 1.7ZM9.9 14a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                            </svg>
                                            Lihat Detail Tugas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div
                        class="rounded-xl bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700 overflow-hidden">
                        <div class="flex items-start gap-3 p-4">
                            <span
                                class="inline-flex shrink-0 h-7 min-w-[1.75rem] items-center justify-center rounded-md
                           bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-100 text-xs font-semibold">
                                {{ $no++ }}
                            </span>
                            <div class="min-w-0">
                                <p class="text-[13px] uppercase tracking-wide text-slate-500 dark:text-slate-400">Nama
                                    Tugas</p>
                                <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 truncate">
                                    {{ $tugas->nama_tugas }}
                                </h3>

                                <div class="mt-3">
                                    <span
                                        class="inline-flex items-center rounded-md bg-red-50 text-red-700 border border-red-200
                                 px-2 py-1 text-xs font-medium dark:bg-red-500/10 dark:text-red-200 dark:border-red-500/20">
                                        Belum ada mahasiswa
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div
                    class="rounded-xl bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700 p-6 text-center">
                    <p class="text-slate-600 dark:text-slate-300">Belum ada data tugas.</p>
                </div>
            @endforelse
        </div>

        {{-- DESKTOP TABLE ( >= md ) --}}
        <div
            class="hidden md:block rounded-xl overflow-hidden bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-50 dark:bg-slate-700/60 sticky top-0 z-10">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">No</th>
                            <th scope="col"
                                class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">Nama Tugas
                            </th>
                            <th scope="col"
                                class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">Nama
                                Mahasiswa</th>
                            <th scope="col"
                                class="px-4 py-3 text-center font-semibold text-slate-600 dark:text-slate-200">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @php $no = $dataTugas->firstItem(); @endphp
                        @forelse ($dataTugas as $tugas)
                            @if ($tugas->mahasiswa->count() > 0)
                                @foreach ($tugas->mahasiswa as $mahasiswa)
                                    <tr
                                        class="odd:bg-slate-50/50 dark:odd:bg-slate-900/20 hover:bg-slate-50 dark:hover:bg-slate-700/40 transition-colors">
                                        <td class="px-4 py-3 text-slate-700 dark:text-slate-100 whitespace-nowrap">
                                            {{ $no++ }}</td>
                                        <td class="px-4 py-3 text-slate-800 dark:text-slate-100 max-w-[24rem] truncate">
                                            {{ $tugas->nama_tugas }}</td>
                                        <td class="px-4 py-3 text-slate-800 dark:text-slate-100 max-w-[20rem] truncate">
                                            {{ $mahasiswa->nama_mahasiswa ?? 'Tidak ada' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ route('admin.project.mahasiswa', ['mahasiswa' => $mahasiswa->slug, 'tugas' => $tugas->slug]) }}"
                                                    class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white
                                  px-4 py-2 focus-visible:ring-2 focus-visible:ring-amber-400">
                                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M19.8 21.6 13.3 15.1c-.9.7-2.1 1.1-3.4 1.1A6 6 0 1 1 16 10c0 1.2-.4 2.4-1.1 3.4l6.5 6.5-1.6 1.7ZM9.9 14a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                                                    </svg>
                                                    Lihat Detail Tugas
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="odd:bg-slate-50/50 dark:odd:bg-slate-900/20">
                                    <td class="px-4 py-3 text-slate-700 dark:text-slate-100 whitespace-nowrap">
                                        {{ $no++ }}</td>
                                    <td class="px-4 py-3 text-slate-800 dark:text-slate-100 max-w-[24rem] truncate">
                                        {{ $tugas->nama_tugas }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="inline-flex items-center rounded-md bg-red-50 text-red-700 border border-red-200
                                   px-2 py-1 text-xs font-medium dark:bg-red-500/10 dark:text-red-200 dark:border-red-500/20">
                                            Belum ada mahasiswa
                                        </span>
                                    </td>
                                    <td class="px-4 py-3"></td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-slate-600 dark:text-slate-300">
                                    Belum ada data tugas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $dataTugas->links() }}
        </div>
    </div>
</x-layout>
