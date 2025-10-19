<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div x-data="{
        openModalCreateTugas: false,
        openModalUpdateTugas: false,
        openModalDeleteTugas: false,
        idTugas: null,
        dataTugas: {},
    }" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-2 py-6">
        {{-- Toolbar --}}
        <div
            class="bg-white dark:bg-gray-800/90 shadow-sm ring-1 ring-slate-200/70 dark:ring-slate-700 rounded-xl p-4 mb-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Data Tugas</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Kelola daftar tugas dan project.</p>
                </div>

                <div class="flex gap-2">
                    <button type="button" @click="openModalCreateTugas = true"
                        class="inline-flex items-center gap-2 rounded-lg bg-green-600 hover:bg-green-700 text-white px-4 py-2 text-sm font-medium">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2h6Z" />
                        </svg>
                        Tambahkan Tugas
                    </button>

                    <form action="#" method="GET" class="hidden sm:block">
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                            </span>
                            <input
                                class="w-72 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700/70
                     pl-10 pr-3 py-2 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400
                     focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Cari Data" name="search" autocomplete="off">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div
            class="rounded-xl overflow-hidden bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-center text-slate-600 dark:text-slate-200">
                    <thead class="bg-slate-50 dark:bg-slate-700/60 sticky top-0 z-10">
                        <tr>
                            <th class="w-14 px-4 py-3 font-semibold">No</th>
                            <th class="px-4 py-3 font-semibold text-left">Nama Tugas</th>
                            <th class="px-4 py-3 font-semibold">Nama Project</th>
                            <th class="w-60 px-4 py-3 font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($data_tugas as $tugas)
                            <tr
                                class="odd:bg-slate-50/40 dark:odd:bg-slate-900/20 hover:bg-slate-50 dark:hover:bg-slate-700/40 transition-colors">
                                <td class="px-4 py-3">{{ $data_tugas->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 text-left">
                                    <span
                                        class="font-medium text-slate-800 dark:text-slate-100">{{ $tugas->nama_tugas }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="{{ route('admin.project', $tugas->slug) }}"
                                        class="inline-flex items-center gap-2 rounded-md bg-amber-500 hover:bg-amber-600 text-white px-3 py-2">
                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M11 7h2v5h4v2h-6V7Z" />
                                            <path
                                                d="M12 22q-2.9 0-5.45-1.1-2.55-1.1-4.45-3-1.9-1.9-3-4.45Q-2 10.9-2 8q0-2.9 1.1-5.45 1.1-2.55 3-4.45 1.9-1.9 4.45-3Q9.1-10 12-10q2.9 0 5.45 1.1 2.55 1.1 4.45 3 1.9 1.9 3 4.45Q26 5.1 26 8q0 2.9-1.1 5.45-1.1 2.55-3 4.45-1.9 1.9-4.45 3Q14.9 22 12 22Z" />
                                        </svg>
                                        Lihat Detail Project
                                    </a>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                            @click="openModalUpdateTugas = true; dataTugas = @js($tugas);"
                                            class="inline-flex items-center gap-2 rounded-md bg-amber-500 hover:bg-amber-600 text-white px-3 py-2">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25ZM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0L14.13 4.7l3.75 3.75 2.83-2.41Z" />
                                            </svg>
                                            Ubah
                                        </button>

                                        <button type="button"
                                            @click="openModalDeleteTugas = true; idTugas={{ $tugas->id }};"
                                            class="inline-flex items-center gap-2 rounded-md bg-red-600 hover:bg-red-700 text-white px-3 py-2">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M6 19a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7H6v12ZM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4Z" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="p-4">
                {{ $data_tugas->links() }}
            </div>
        </div>

        {{-- Modal Tambahkan Tugas --}}
        <div x-cloak x-show="openModalCreateTugas"
            class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow w-full max-w-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-slate-800 dark:text-slate-100">Upload Tugas Baru</h3>
                <form action="{{ route('admin.data.tugas.create', $admin) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama
                            Tugas</label>
                        <input type="text" name="nama_tugas"
                            class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700/70 px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openModalCreateTugas=false"
                            class="rounded-lg border border-slate-300 dark:border-slate-600 px-4 py-2">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-green-600 hover:bg-green-700 text-white px-4 py-2">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Update Tugas --}}
        <div x-cloak x-show="openModalUpdateTugas"
            class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow w-full max-w-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-slate-800 dark:text-slate-100">Update Tugas</h3>
                <form action="{{ route('admin.data.tugas.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="tugas_id" :value="dataTugas.id">
                    <input type="hidden" name="admin_id" :value="dataTugas.admin_id">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama
                            Tugas</label>
                        <input type="text" name="nama_tugas" :value="dataTugas.nama_tugas"
                            class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700/70 px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openModalUpdateTugas=false"
                            class="rounded-lg border border-slate-300 dark:border-slate-600 px-4 py-2">Batal</button>
                        <button type="submit"
                            class="rounded-lg bg-green-600 hover:bg-green-700 text-white px-4 py-2">Upload</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Modal Delete --}}
        <div x-cloak x-show="openModalDeleteTugas"
            class="fixed inset-0 bg-black/50 flex items-center justify-center p-4">
            <form action="{{ route('admin.data.tugas.delete') }}" method="POST" class="w-full max-w-md">
                @csrf
                <input type="hidden" name="id" :value="idTugas">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow p-6 text-center">
                    <h4 class="text-base font-semibold text-slate-800 dark:text-slate-100 mb-2">Hapus Tugas</h4>
                    <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">Apakah anda yakin ingin menghapus tugas
                        ini?
                    </p>
                    <div class="flex justify-center gap-3">
                        <button type="button" @click="openModalDeleteTugas=false"
                            class="rounded-lg border border-slate-300 dark:border-slate-600 px-4 py-2">Tidak</button>
                        <button type="submit" class="rounded-lg bg-red-600 hover:bg-red-700 text-white px-4 py-2">Ya,
                            saya yakin</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</x-layout>
