<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div x-data="{
        deleteAll: false,
        hapus1Data: false,
        noHapus: 0,
        actionsOpen: false,
    }" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-2 py-6">
        {{-- Toolbar: Title + Search + Actions --}}
        <div
            class="bg-white dark:bg-gray-800/80 shadow-sm ring-1 ring-slate-200/60 dark:ring-slate-700 rounded-xl p-4 mb-6">
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-800 dark:text-slate-100">Data Mahasiswa</h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Kelola, cari, dan ekspor data mahasiswa.</p>
                </div>

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    {{-- Actions dropdown (desktop & mobile) --}}
                    <div class="relative order-2 sm:order-1">
                        <button @click="actionsOpen = !actionsOpen" @keydown.escape.window="actionsOpen = false"
                            class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-medium
                     text-white bg-blue-600 hover:bg-blue-700 focus-visible:ring-2 focus-visible:ring-blue-500"
                            type="button">
                            Action Menu
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5.25 7.5 10 12.25 14.75 7.5h-9.5Z" />
                            </svg>
                        </button>

                        <div x-cloak x-show="actionsOpen" x-transition.origin.top.left @click.away="actionsOpen=false"
                            class="absolute z-20 mt-2 w-48 rounded-lg bg-white dark:bg-slate-800 shadow-lg ring-1 ring-slate-200/70 dark:ring-slate-700 overflow-hidden">
                            <ul class="py-1 text-sm text-slate-700 dark:text-slate-200">
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                        Add Data Contract
                                    </a>
                                </li>
                                <li class="px-4 py-2">
                                    <form action="#" method="POST" enctype="multipart/form-data"
                                        id="uploadFileForm" class="space-y-2">
                                        @csrf
                                        <label
                                            class="inline-flex w-full items-center justify-between cursor-pointer rounded-md border border-slate-200 dark:border-slate-600 px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-700/40">
                                            <span>Import Data</span>
                                            <input id="fileInput" name="excel_file" type="file" class="hidden"
                                                onchange="document.getElementById('uploadFileForm').submit()" />
                                            <svg class="h-4 w-4 opacity-70" viewBox="0 0 24 24" fill="currentColor">
                                                <path
                                                    d="M12 16v-6l-2.5 2.5-1.42-1.42L12 5.66l3.92 3.92-1.42 1.42L13 10v6h-1Zm-7 4q-.825 0-1.413-.588T3 18v-4h2v4h14v-4h2v4q0 .825-.588 1.413T19 20H5Z" />
                                            </svg>
                                        </label>
                                    </form>
                                </li>
                                <li>
                                    <form action="#" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-700/50">
                                            Export Data
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <button type="button" @click="deleteAll = true; actionsOpen=false"
                                        class="w-full text-left px-4 py-2 hover:bg-slate-50 dark:hover:bg-slate-700/50 text-red-600 dark:text-red-400">
                                        Delete All Data
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Search --}}
                    <form action="{{ route('admin.cari_data_mahasiswa') }}" method="GET" class="order-1 sm:order-2">
                        <div class="flex gap-2">
                            <div class="relative w-[70vw] max-w-md sm:w-80">
                                <label for="search" class="sr-only">Cari Data Mahasiswa</label>
                                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round"
                                            d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                    </svg>
                                </span>
                                <input id="search" name="search" autocomplete="off"
                                    class="w-full rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-700/70
                         pl-10 pr-3 py-2 text-sm text-slate-800 dark:text-slate-100 placeholder-slate-400
                         focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    type="text" placeholder="Cari Data Mahasiswa">
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
        </div>

        {{-- MOBILE CARDS ( < md ) --}}
        <div class="md:hidden space-y-3">
            @forelse ($data_mahasiswa as $m)
                <div
                    class="rounded-xl bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700 p-4">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset($m->pas_foto) }}" alt="Pas foto {{ $m->nama_mahasiswa }}"
                            class="h-14 w-14 rounded-full object-cover ring-2 ring-white outline -outline-offset-1 outline-black/5">
                        <div class="min-w-0">
                            <h3 class="text-base font-semibold text-slate-800 dark:text-slate-100 truncate">
                                {{ $m->nama_mahasiswa }}
                            </h3>
                            <p class="text-sm text-slate-600 dark:text-slate-300">
                                NIM: <span class="font-medium">{{ $m->nim }}</span>
                            </p>
                            <p class="text-sm text-slate-600 dark:text-slate-300">
                                Semester: <span class="font-medium">{{ $m->semester }}</span> • No Handphone:
                                <span class="font-medium">{{ $m->no_hp }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-4 flex gap-2">
                        <a href="#"
                            class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white px-3 py-2 text-sm">
                            <svg class="h-4 w-4" viewBox="0 0 576 512" fill="currentColor">
                                <path
                                    d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                            </svg>
                            Edit
                        </a>
                        <button type="button" @click="hapus1Data = true; noHapus='{{ $m->contr_id }}'"
                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 hover:bg-red-700 text-white px-3 py-2 text-sm">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.48v.23c1.35.15 2.64.35 3.88.51a.75.75 0 0 1-.47 1.44l-.2-.03-1 13.07a3 3 0 0 1-2.99 2.76H8.08a3 3 0 0 1-2.99-2.76L4.09 6.63l-.2.03a.75.75 0 0 1-.47-1.44c1.24-.16 2.53-.36 3.88-.51v-.23c0-1.56 1.21-2.9 2.82-2.95a52.7 52.7 0 0 1 3.37 0c1.61.05 2.83 1.39 2.83 2.95Zm-6.49-1.45c1.09-.04 2.18-.04 3.27 0.04.75.03 1.22.66 1.22 1.45v.11a49.5 49.5 0 0 0-6 0v-.11c0-.79.61-1.42 1.51-1.49ZM8.5 9.0a.75.75 0 0 0-1.5.06l.35 9a.75.75 0 0 0 1.5-.06l-.35-9Zm5.48.06a.75.75 0 0 0-1.5-.06l-.35 9a.75.75 0 1 0 1.5.06l.35-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </div>
                </div>
            @empty
                <div
                    class="rounded-xl bg-white dark:bg-slate-800 shadow ring-1 ring-slate-200/70 dark:ring-slate-700 p-6 text-center">
                    <p class="text-slate-600 dark:text-slate-300">Belum ada data mahasiswa.</p>
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
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">No</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">Nama
                                Mahasiswa</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">NIM</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">Semester
                            </th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">No
                                Handphone</th>
                            <th class="px-4 py-3 text-left font-semibold text-slate-600 dark:text-slate-200">Pas Foto
                            </th>
                            <th class="px-4 py-3 text-center font-semibold text-slate-600 dark:text-slate-200">Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @foreach ($data_mahasiswa as $mahasiswa)
                            <tr
                                class="odd:bg-slate-50/50 dark:odd:bg-slate-900/20 hover:bg-slate-50 dark:hover:bg-slate-700/40 transition-colors">
                                <td class="px-4 py-3 text-slate-700 dark:text-slate-100 whitespace-nowrap">
                                    {{ $data_mahasiswa->firstItem() + $loop->index }}
                                </td>
                                <td class="px-4 py-3 text-slate-800 dark:text-slate-100 max-w-[18rem] truncate">
                                    {{ $mahasiswa->nama_mahasiswa }}
                                </td>
                                <td class="px-4 py-3 text-slate-800 dark:text-slate-100 whitespace-nowrap">
                                    {{ $mahasiswa->nim }}
                                </td>
                                <td class="px-4 py-3 text-slate-800 dark:text-slate-100 whitespace-nowrap">
                                    {{ $mahasiswa->semester }}
                                </td>
                                <td class="px-4 py-3 text-slate-800 dark:text-slate-100 whitespace-nowrap">
                                    {{ $mahasiswa->no_hp }}
                                </td>
                                <td class="px-4 py-3">
                                    <img src="{{ asset($mahasiswa->pas_foto) }}"
                                        alt="Pas foto {{ $mahasiswa->nama_mahasiswa }}"
                                        class="h-12 w-12 rounded-full object-cover ring-2 ring-white outline -outline-offset-1 outline-black/5">
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="#"
                                            class="inline-flex items-center gap-2 rounded-lg bg-amber-500 hover:bg-amber-600 text-white px-3 py-2">
                                            <svg class="h-4 w-4" viewBox="0 0 576 512" fill="currentColor">
                                                <path
                                                    d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button"
                                            @click="hapus1Data = true; noHapus='{{ $mahasiswa->contr_id }}'"
                                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 hover:bg-red-700 text-white px-3 py-2">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.5 4.48v.23c1.35.15 2.64.35 3.88.51a.75.75 0 0 1-.47 1.44l-.2-.03-1 13.07a3 3 0 0 1-2.99 2.76H8.08a3 3 0 0 1-2.99-2.76L4.09 6.63l-.2.03a.75.75 0 0 1-.47-1.44c1.24-.16 2.53-.36 3.88-.51v-.23c0-1.56 1.21-2.9 2.82-2.95a52.7 52.7 0 0 1 3.37 0c1.61.05 2.83 1.39 2.83 2.95Zm-6.49-1.45c1.09-.04 2.18-.04 3.27 0.04.75.03 1.22.66 1.22 1.45v.11a49.5 49.5 0 0 0-6 0v-.11c0-.79.61-1.42 1.51-1.49ZM8.5 9.0a.75.75 0 0 0-1.5.06l.35 9a.75.75 0 0 0 1.5-.06l-.35-9Zm5.48.06a.75.75 0 0 0-1.5-.06l-.35 9a.75.75 0 1 0 1.5.06l.35-9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="p-4">
                {{ $data_mahasiswa->links() }}
            </div>
        </div>

        {{-- ===== Modals ===== --}}
        {{-- Delete All --}}
        <div x-cloak x-show="deleteAll" x-transition
            class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-md rounded-lg bg-white dark:bg-slate-800 shadow p-5">
                <button @click="deleteAll=false" type="button"
                    class="absolute top-2.5 right-2.5 rounded-md p-1.5 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293A1 1 0 0 1 4.293 14.293L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
                <div class="text-center">
                    <svg class="mx-auto mb-3.5 h-11 w-11 text-slate-400 dark:text-slate-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 1 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9zM7 8a1 1 0 1 1 2 0v6a1 1 0 1 1-2 0V8zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-slate-600 dark:text-slate-300">Are you sure you want to delete all data?</p>
                    <div class="flex justify-center gap-3">
                        <button @click="deleteAll=false" type="button"
                            class="px-3 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                            No, cancel
                        </button>
                        <form action="#" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-3 py-2 text-sm rounded-lg bg-red-600 hover:bg-red-700 text-white">
                                Yes, I'm sure
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Delete One --}}
        <div x-cloak x-show="hapus1Data" x-transition
            class="fixed inset-0 z-50 bg-black/50 flex items-center justify-center p-4">
            <div class="relative w-full max-w-md rounded-lg bg-white dark:bg-slate-800 shadow p-5">
                <button @click="hapus1Data=false" type="button"
                    class="absolute top-2.5 right-2.5 rounded-md p-1.5 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 0 1 1.414 0L10 8.586l4.293-4.293a1 1 0 1 1 1.414 1.414L11.414 10l4.293 4.293a1 1 0 0 1-1.414 1.414L10 11.414l-4.293 4.293A1 1 0 0 1 4.293 14.293L8.586 10 4.293 5.707a1 1 0 0 1 0-1.414Z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close</span>
                </button>
                <div class="text-center">
                    <svg class="mx-auto mb-3.5 h-11 w-11 text-slate-400 dark:text-slate-500" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 1 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9zM7 8a1 1 0 1 1 2 0v6a1 1 0 1 1-2 0V8zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-slate-600 dark:text-slate-300">Are you sure you want to delete this data?</p>
                    <div class="flex justify-center gap-3">
                        <button @click="hapus1Data=false" type="button"
                            class="px-3 py-2 text-sm rounded-lg border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700/40">
                            No, cancel
                        </button>
                        <form x-bind:action="'/contract/' + noHapus" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="px-3 py-2 text-sm rounded-lg bg-red-600 hover:bg-red-700 text-white">
                                Yes, delete it
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- ===== End Modals ===== --}}
    </div>
</x-layout>
