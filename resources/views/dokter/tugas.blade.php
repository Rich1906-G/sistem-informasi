<x-layout-dokter>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div x-data="{
        openModalCreateTugas: false,
        openModalUpdateTugas: false,
        openModalDeleteTugas: false,
        dataTugas: {},
        idTugas: null
    }" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-8">

        {{-- ======= Toolbar ======= --}}
        <section class="mt-4 mb-4">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total: <span class="font-medium">{{ $data_tugas->total() }}</span>
                        tugas</p>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center w-full md:w-auto">
                    {{-- Search --}}
                    <form action="#" method="GET" class="relative w-full sm:w-80">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-500" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m21 21-3.5-3.5" />
                            <circle cx="10" cy="10" r="7" />
                        </svg>
                        <input id="search" name="search" value="{{ request('search') }}"
                            placeholder="Cari tugas atau proyek…"
                            class="w-full rounded-xl border border-slate-300 bg-white pl-10 pr-3 py-2.5 text-sm text-slate-900 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            autocomplete="off" type="text" />
                        @if (request('search'))
                            <a href="{{ url()->current() }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-xs px-2 py-1 rounded-md bg-slate-100 text-slate-600 hover:bg-slate-200">
                                Clear
                            </a>
                        @endif
                    </form>

                    {{-- Tambah (desktop & tablet) --}}
                    <button type="button" @click="openModalCreateTugas = true"
                        class="hidden sm:inline-flex items-center gap-2 rounded-xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Tambahkan Tugas
                    </button>
                </div>
            </div>

            {{-- Tambah (khusus mobile) --}}
            <div class="mt-3 sm:hidden">
                <button type="button" @click="openModalCreateTugas = true"
                    class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14" />
                    </svg>
                    Tambah Tugas
                </button>
            </div>
        </section>

        {{-- ======= List Desktop (Table) ======= --}}
        <div class="hidden md:block">
            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full text-sm">
                    <thead class="sticky top-0 bg-slate-50 text-slate-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center w-14">No</th>
                            <th class="px-4 py-3 text-left">Nama Tugas</th>
                            <th class="px-4 py-3 text-left">Proyek</th>
                            <th class="px-4 py-3 text-center w-64">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($data_tugas as $tugas)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-center">{{ $data_tugas->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 font-medium text-slate-900">
                                    {{ $tugas->nama_tugas }}
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('dokter.project', $tugas->slug) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-3 py-2 text-white hover:bg-amber-600 focus:ring-4 focus:ring-amber-300">
                                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path d="M13 16h-1v-4h-1M12 8h.01" />
                                            <rect x="3" y="3" width="18" height="18" rx="2" />
                                        </svg>
                                        Lihat Project
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                            @click="openModalUpdateTugas = true; dataTugas = @js($tugas);"
                                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                            </svg>
                                            Ubah
                                        </button>

                                        <button type="button"
                                            @click="openModalDeleteTugas = true; idTugas = {{ $tugas->id }};"
                                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6M14 11v6" />
                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-slate-500">
                                    Belum ada tugas yang cocok. Coba ubah kata kunci atau tambahkan tugas baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $data_tugas->links() }}
            </div>
        </div>

        {{-- ======= List Mobile (Cards) ======= --}}
        <div class="md:hidden space-y-3">
            @forelse ($data_tugas as $tugas)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs text-slate-500">#{{ $data_tugas->firstItem() + $loop->index }}</p>
                            <h3 class="mt-1 text-base font-semibold text-slate-900">{{ $tugas->nama_tugas }}</h3>
                        </div>
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <a href="{{ route('dokter.project', $tugas->slug) }}"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-amber-500 px-3 py-2 text-sm font-medium text-white hover:bg-amber-600">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" />
                                <path d="M12 8h.01M12 12h.01M12 16h.01" />
                            </svg>
                            Project
                        </a>
                        <button type="button"
                            @click="openModalUpdateTugas = true; dataTugas = @js($tugas);"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                            </svg>
                            Ubah
                        </button>
                        <button type="button" @click="openModalDeleteTugas = true; idTugas = {{ $tugas->id }};"
                            class="inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white hover:bg-red-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <polyline points="3 6 5 6 21 6" />
                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                <path d="M10 11v6M14 11v6" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </div>
            @empty
                <div class="rounded-2xl border border-slate-200 bg-white p-8 text-center text-slate-500">
                    Belum ada tugas. Tekan <span class="font-medium">“Tambahkan Tugas”</span> di atas.
                </div>
            @endforelse

            <div class="mt-4">
                {{ $data_tugas->links() }}
            </div>
        </div>

        {{-- ======= Modal: Tambah ======= --}}
        <div x-cloak x-show="openModalCreateTugas" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <div x-transition.scale.duration.150ms
                class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Upload Tugas Baru</h2>
                    <button @click="openModalCreateTugas=false" class="rounded-lg p-2 hover:bg-slate-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('dokter.data.tugas.create', $dokter) }}" method="POST" class="grid gap-4">
                    @csrf
                    <label class="grid gap-1">
                        <span class="text-sm font-medium text-slate-700">Nama Tugas</span>
                        <input name="nama_tugas" type="text"
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Pemeriksaan Radiologi" required>
                    </label>

                    <div class="mt-2 flex justify-end gap-2">
                        <button type="button" @click="openModalCreateTugas=false"
                            class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="rounded-xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ======= Modal: Update ======= --}}
        <div x-cloak x-show="openModalUpdateTugas" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <div x-transition.scale.duration.150ms
                class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Update Tugas</h2>
                    <button @click="openModalUpdateTugas=false" class="rounded-lg p-2 hover:bg-slate-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('dokter.data.tugas.update', $dokter) }}" method="POST" class="grid gap-4">
                    @csrf
                    <input type="hidden" name="tugas_id" :value="dataTugas.id">

                    <label class="grid gap-1">
                        <span class="text-sm font-medium text-slate-700">Nama Tugas</span>
                        <input name="nama_tugas" type="text" :value="dataTugas.nama_tugas"
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                    </label>

                    <div class="mt-2 flex justify-end gap-2">
                        <button type="button" @click="openModalUpdateTugas=false"
                            class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ======= Modal: Delete ======= --}}
        <div x-cloak x-show="openModalDeleteTugas" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <form action="{{ route('dokter.data.tugas.delete') }}" method="POST" x-transition.scale.duration.150ms
                class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                @csrf
                <input type="hidden" name="id" :value="idTugas">
                <div class="text-center">
                    <div class="mx-auto mb-3 grid h-12 w-12 place-items-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11 15h2V9h-2v6Zm1-13q.425 0 .713.288Q13 2.575 13 3v2h-2V3q0-.425.288-.712Q11.575 2 12 2ZM6 21q-.825 0-1.412-.587Q4 19.825 4 19V7h16v12q0 .825-.587 1.413Q18.825 21 18 21Zm2-4h8v-8H8Zm0 0v-8 8Z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-slate-900">Hapus Tugas?</h3>
                    <p class="mb-4 text-sm text-slate-600">Aksi ini tidak bisa dibatalkan.</p>
                </div>
                <div class="mt-2 flex justify-center gap-2">
                    <button type="button" @click="openModalDeleteTugas=false"
                        class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                        Ya, hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout-dokter>
