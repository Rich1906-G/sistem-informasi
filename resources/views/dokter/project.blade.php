<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('images/logo_rsgm.png') }}">
    <x-title>{{ $title }}</x-title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>
</head>

<body class="bg-slate-50">
    <div x-data="{
        openModalCreateProject: false,
        openModalUpdateProject: false,
        openModalDeleteProject: false,
        idTugas: null,
        idProject: null,
        dataProject: {}
    }" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-8 py-6">
        {{-- ================= HEADER / HERO ================= --}}
        <header class="mb-6">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-500">Detail Tugas</p>
                    <h1 class="mt-1 text-2xl sm:text-3xl font-extrabold leading-tight text-slate-900">
                        {{ $data_tugas->nama_tugas }}
                    </h1>
                    <p class="text-sm text-slate-500">
                        Total project: <span class="font-medium">{{ $data_project->total() }}</span>
                    </p>
                </div>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('dokter.data.tugas') }}"
                        class="inline-flex items-center gap-2 rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15 18l-6-6 6-6" />
                        </svg>
                        Kembali
                    </a>
                    <button type="button" @click="openModalCreateProject = true; idTugas = {{ $data_tugas->id }};"
                        class="inline-flex items-center gap-2 rounded-xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 5v14M5 12h14" />
                        </svg>
                        Tambahkan Project
                    </button>
                </div>
            </div>

            {{-- Toolbar: Search --}}
            <div class="mt-4">
                <form action="#" method="GET" class="relative sm:w-96">
                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-500"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="m21 21-3.5-3.5" />
                        <circle cx="10" cy="10" r="7" />
                    </svg>
                    <input id="search" name="search" value="{{ request('search') }}" placeholder="Cari project…"
                        autocomplete="off"
                        class="w-full rounded-xl border border-slate-300 bg-white pl-10 pr-3 py-2.5 text-sm text-slate-900 outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        type="text" />
                    @if (request('search'))
                        <a href="{{ url()->current() }}"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-xs px-2 py-1 rounded-md bg-slate-100 text-slate-600 hover:bg-slate-200">
                            Clear
                        </a>
                    @endif
                </form>
            </div>
        </header>

        {{-- ================= DESKTOP TABLE ================= --}}
        <section class="hidden md:block">
            <div class="overflow-x-auto rounded-2xl border border-slate-200 bg-white shadow-sm">
                <table class="min-w-full text-sm">
                    <thead class="sticky top-0 bg-slate-50 text-slate-700 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-3 text-center w-14">No</th>
                            <th class="px-4 py-3 text-left">Nama Project</th>
                            <th class="px-4 py-3 text-center w-72">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($data_project as $project)
                            <tr class="hover:bg-slate-50">
                                <td class="px-4 py-3 text-center">{{ $data_project->firstItem() + $loop->index }}</td>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $project->nama_project }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button"
                                            @click="openModalUpdateProject = true; dataProject = @js($project);"
                                            class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                            </svg>
                                            Ubah
                                        </button>

                                        <button type="button"
                                            @click="openModalDeleteProject = true; idProject = {{ $project->id }};"
                                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6M14 11v6" />
                                                <path d="M9 6V4h6v2" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-slate-500">
                                    Belum ada project untuk tugas ini. Tambahkan project dengan tombol di atas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $data_project->links() }}</div>
        </section>

        {{-- ================= MOBILE CARDS ================= --}}
        <section class="md:hidden space-y-3">
            @forelse ($data_project as $project)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-start justify-between gap-3">
                        <div>
                            <p class="text-xs text-slate-500">#{{ $data_project->firstItem() + $loop->index }}</p>
                            <h3 class="mt-1 text-base font-semibold text-slate-900">{{ $project->nama_project }}</h3>
                        </div>
                    </div>

                    <div class="mt-3 flex flex-wrap items-center gap-2">
                        <button type="button"
                            @click="openModalUpdateProject = true; dataProject = @js($project);"
                            class="inline-flex flex-1 items-center justify-center gap-2 rounded-lg bg-blue-600 px-3 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M12 20h9" />
                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                            </svg>
                            Ubah
                        </button>
                        <button type="button"
                            @click="openModalDeleteProject = true; idProject = {{ $project->id }};"
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
                    Belum ada project. Tekan <span class="font-medium">“Tambahkan Project”</span> di atas.
                </div>
            @endforelse

            <div class="mt-4">{{ $data_project->links() }}</div>
        </section>

        {{-- ================= MODAL: CREATE ================= --}}
        <div x-cloak x-show="openModalCreateProject" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <div x-transition.scale.duration.150ms
                class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Upload Project Baru</h2>
                    <button @click="openModalCreateProject=false" class="rounded-lg p-2 hover:bg-slate-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('dokter.tambah.project') }}" method="POST" class="grid gap-4">
                    @csrf
                    <label class="grid gap-1">
                        <span class="text-sm font-medium text-slate-700">Nama Project</span>
                        <input name="nama_project" type="text" required
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Contoh: Pemeriksaan Radiologi">
                    </label>
                    <input type="hidden" name="tugas_id" :value="idTugas">

                    <div class="mt-2 flex justify-end gap-2">
                        <button type="button" @click="openModalCreateProject=false"
                            class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="rounded-xl bg-green-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ================= MODAL: UPDATE ================= --}}
        <div x-cloak x-show="openModalUpdateProject" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <div x-transition.scale.duration.150ms
                class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-lg font-semibold">Update Project</h2>
                    <button @click="openModalUpdateProject=false" class="rounded-lg p-2 hover:bg-slate-100">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form action="{{ route('dokter.edit.project') }}" method="POST" class="grid gap-4">
                    @csrf
                    <input type="hidden" name="id" :value="dataProject.id">

                    <label class="grid gap-1">
                        <span class="text-sm font-medium text-slate-700">Nama Project</span>
                        <input name="nama_project" type="text" :value="dataProject.nama_project" required
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </label>

                    <div class="mt-2 flex justify-end gap-2">
                        <button type="button" @click="openModalUpdateProject=false"
                            class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                        <button type="submit"
                            class="rounded-xl bg-blue-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- ================= MODAL: DELETE ================= --}}
        <div x-cloak x-show="openModalDeleteProject" x-transition.opacity.duration.150ms
            class="fixed inset-0 z-50 grid place-items-center bg-black/50 p-4">
            <form action="{{ route('dokter.delete.project') }}" method="POST" x-transition.scale.duration.150ms
                class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl ring-1 ring-slate-200">
                @csrf
                <input type="hidden" name="id" :value="idProject">
                <div class="text-center">
                    <div class="mx-auto mb-3 grid h-12 w-12 place-items-center rounded-full bg-red-50 text-red-600">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11 15h2V9h-2v6Zm1-13q.425 0 .713.288Q13 2.575 13 3v2h-2V3q0-.425.288-.712Q11.575 2 12 2ZM6 21q-.825 0-1.412-.587Q4 19.825 4 19V7h16v12q0 .825-.587 1.413Q18.825 21 18 21Zm2-4h8v-8H8Z" />
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-semibold text-slate-900">Hapus Project?</h3>
                    <p class="mb-4 text-sm text-slate-600">Aksi ini tidak bisa dibatalkan.</p>
                </div>
                <div class="mt-2 flex justify-center gap-2">
                    <button type="button" @click="openModalDeleteProject=false"
                        class="rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50">Batal</button>
                    <button type="submit"
                        class="rounded-xl bg-red-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                        Ya, hapus
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
