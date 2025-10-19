<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/logo_rsgm.png') }}">
    <x-title>{{ $title }}</x-title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>
</head>

<body>
    <div x-data="{
        openModalUploadProject: false,
        openModalUpdateProject: false,
        openModalDeleteProject: false,
        idTugas: {{ $slugTugas->id }},
        idProject: null,
        dataProject: {},
        keyword: '{{ request('search') }}',
    }" class="mx-auto w-full max-w-7xl px-4 sm:px-6 md:px-8 py-8">
        <section
            class="rounded-2xl overflow-hidden bg-white dark:bg-gray-800 shadow-lg ring-1 ring-slate-200/70 dark:ring-gray-700">
            {{-- ===== HERO / HEADER ===== --}}
            <div class="relative">
                <div class="h-24 bg-gradient-to-r from-blue-900 via-indigo-800 to-blue-700"></div>
                <div class="-mt-10 px-4 sm:px-6">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl sm:text-3xl font-bold text-white drop-shadow">
                                Detail Tugas: {{ $slugTugas->nama_tugas }}
                            </h2>
                            <p class="text-white/80 text-sm drop-shadow">
                                {{ number_format($dataProject->total()) }} project terdaftar
                            </p>
                        </div>

                        {{-- Search --}}
                        <form action="#" method="GET" class="w-full lg:w-auto">
                            <div class="relative">
                                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-500"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m21 21-3.5-3.5" />
                                    <circle cx="10" cy="10" r="7" />
                                </svg>
                                <input x-model="keyword" id="search" name="search" autocomplete="off"
                                    placeholder="Cari project…" type="search"
                                    class="w-full lg:w-96 rounded-xl border border-slate-300 bg-white pl-10 pr-20 py-2.5 text-sm text-slate-900
                       outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                       dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                                <div class="absolute right-2 top-1/2 -translate-y-1/2 flex gap-2">
                                    <button type="button" @click="keyword=''; $refs.searchForm.submit()"
                                        class="hidden sm:inline-flex items-center rounded-lg bg-slate-100 px-2 py-1 text-xs text-slate-600 hover:bg-slate-200">
                                        Clear
                                    </button>
                                    <button type="submit"
                                        class="inline-flex items-center rounded-lg bg-blue-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-blue-700">
                                        Search
                                    </button>
                                </div>
                            </div>
                            <input type="submit" class="hidden" x-ref="searchForm" />
                        </form>
                    </div>
                </div>
            </div>

            {{-- ===== DESKTOP TABLE ===== --}}
            <div class="hidden md:block p-4 sm:p-6">
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-gray-700">
                    <table class="min-w-full text-sm">
                        <thead
                            class="bg-slate-50 dark:bg-gray-700 text-slate-700 dark:text-gray-200 text-xs uppercase sticky top-0">
                            <tr>
                                <th class="px-4 py-3 text-center w-16">No</th>
                                <th class="px-4 py-3 text-left">Nama Project</th>
                                <th class="px-4 py-3 text-left">File Project</th>
                                <th class="px-4 py-3 text-center w-36">Status</th>
                                <th class="px-4 py-3 text-center w-64">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                            @foreach ($dataProject as $project)
                                @php
                                    $attach = $project->mahasiswa->first() ?? null;
                                    $status = strtolower($project->status ?? '');
                                    $badge =
                                        $status === 'selesai' || $status === 'approved'
                                            ? 'bg-emerald-50 text-emerald-700 ring-emerald-200'
                                            : ($status === 'revisi' || $status === 'rejected'
                                                ? 'bg-rose-50 text-rose-700 ring-rose-200'
                                                : 'bg-amber-50 text-amber-700 ring-amber-200');
                                    $label = $project->status ?? 'Proses';
                                @endphp
                                <tr
                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-gray-800 dark:even:bg-gray-800/70 hover:bg-slate-50 dark:hover:bg-gray-700/60">
                                    <td class="px-4 py-3 text-center">
                                        {{ $dataProject->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-900 dark:text-gray-100">
                                        {{ $project->nama_project }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if ($attach && ($attach->pivot->file_project ?? null))
                                            <a href="{{ asset('storage/' . $attach->pivot->file_project) }}"
                                                target="_blank"
                                                class="inline-flex items-center gap-2 text-blue-700 hover:text-blue-800 underline underline-offset-2">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                    <path
                                                        d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                                                </svg>
                                                Lihat File
                                            </a>
                                        @else
                                            <span class="text-slate-400 italic">Belum ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold ring-1 {{ $badge }}">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center gap-2">
                                            <button
                                                @click="
                        openModalUploadProject=true;
                        dataProject=@json($project);
                        idProject={{ $project->id }};
                      "
                                                class="inline-flex items-center gap-2 rounded-lg bg-green-600 px-3 py-2 text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M12 5v14" />
                                                    <path d="M5 12h14" />
                                                </svg>
                                                Upload
                                            </button>

                                            <button
                                                @click="
                        openModalUpdateProject=true;
                        dataProject=@json($project);
                        idProject={{ $project->id }};
                      "
                                                class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-3 py-2 text-white hover:bg-amber-600 focus:ring-4 focus:ring-amber-300">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="M15 12l-8 8H3v-4l8-8" />
                                                    <path d="M18.5 2.5l3 3" />
                                                </svg>
                                                Ubah
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($dataProject->isEmpty())
                                <tr>
                                    <td colspan="5" class="px-4 py-12 text-center text-slate-500 dark:text-gray-300">
                                        Belum ada project.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">{{ $dataProject->links() }}</div>
            </div>

            {{-- ===== MOBILE CARDS ===== --}}
            <div class="md:hidden p-4 sm:p-6 space-y-3">
                @foreach ($dataProject as $project)
                    @php
                        $attach = $project->mahasiswa->first() ?? null;
                        $status = strtolower($project->status ?? '');
                        $badge =
                            $status === 'selesai' || $status === 'approved'
                                ? 'bg-emerald-50 text-emerald-700 ring-emerald-200'
                                : ($status === 'revisi' || $status === 'rejected'
                                    ? 'bg-rose-50 text-rose-700 ring-rose-200'
                                    : 'bg-amber-50 text-amber-700 ring-amber-200');
                        $label = $project->status ?? 'Proses';
                    @endphp
                    <div
                        class="rounded-2xl border border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 shadow-sm">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs text-slate-500">#{{ $dataProject->firstItem() + $loop->index }}</p>
                                <h3 class="mt-1 text-base font-semibold text-slate-900 dark:text-white">
                                    {{ $project->nama_project }}
                                </h3>
                            </div>
                            <span
                                class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold ring-1 {{ $badge }}">
                                {{ $label }}
                            </span>
                        </div>

                        <div class="mt-3 text-sm">
                            @if ($attach && ($attach->pivot->file_project ?? null))
                                <a href="{{ asset('storage/' . $attach->pivot->file_project) }}" target="_blank"
                                    class="inline-flex items-center gap-2 text-blue-700 hover:text-blue-800 underline underline-offset-2">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                        <path d="M17 21H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h7l5 5v11a2 2 0 0 1-2 2z" />
                                    </svg>
                                    Lihat File
                                </a>
                            @else
                                <span class="text-slate-400 italic">Belum ada file</span>
                            @endif
                        </div>

                        <div class="mt-4 grid grid-cols-2 gap-2">
                            <button
                                @click="
                openModalUploadProject=true;
                dataProject=@json($project);
                idProject={{ $project->id }};
              "
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-3 py-2 text-sm text-white hover:bg-green-700">
                                Upload
                            </button>
                            <button
                                @click="
                openModalUpdateProject=true;
                dataProject=@json($project);
                idProject={{ $project->id }};
              "
                                class="inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-3 py-2 text-sm text-white hover:bg-amber-600">
                                Ubah
                            </button>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">{{ $dataProject->links() }}</div>
            </div>

            {{-- ===== Footer actions ===== --}}
            <div class="px-4 sm:px-6 pb-6 flex items-center justify-end">
                <a href="{{ route('mahasiswa.tugas') }}"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700 focus:ring-4 focus:ring-blue-300">
                    ← Kembali
                </a>
            </div>
        </section>

        {{-- ================= MODAL: UPLOAD ================= --}}
        <div x-cloak x-show="openModalUploadProject" x-transition class="fixed inset-0 z-50" role="dialog"
            aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="openModalUploadProject=false"></div>

            <div class="relative mx-auto my-8 w-full max-w-2xl px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6">
                    <button @click="openModalUploadProject=false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <h2 class="text-xl font-bold mb-4 text-slate-900 dark:text-white">Upload Project</h2>

                    <form action="{{ route('mahasiswa.upload.project') }}" method="POST"
                        enctype="multipart/form-data" class="grid gap-4">
                        @csrf
                        <input type="hidden" name="tugas_id" :value="idTugas">
                        <input type="hidden" name="project_id" :value="idProject">

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama Project</label>
                            <input type="text" name="nama_project" :value="dataProject.nama_project" readonly
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">File Project (PDF)</label>
                            <input type="file" name="file_project" accept="application/pdf"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none
                          file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-2 hover:file:bg-slate-200
                          dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openModalUploadProject=false"
                                class="rounded-lg bg-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-300 dark:bg-gray-700 dark:text-gray-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                Upload
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= MODAL: UPDATE ================= --}}
        <div x-cloak x-show="openModalUpdateProject" x-transition class="fixed inset-0 z-50" role="dialog"
            aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="openModalUpdateProject=false"></div>

            <div class="relative mx-auto my-8 w-full max-w-2xl px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6">
                    <button @click="openModalUpdateProject=false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <h2 class="text-xl font-bold mb-4 text-slate-900 dark:text-white">Ubah Project</h2>

                    <form action="{{ route('mahasiswa.update.project') }}" method="POST"
                        enctype="multipart/form-data" class="grid gap-4">
                        @csrf
                        <input type="hidden" name="tugas_id" :value="idTugas">
                        <input type="hidden" name="project_id" :value="idProject">

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama Project</label>
                            <input type="text" name="nama_project" :value="dataProject.nama_project"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Ganti File Project (PDF)</label>
                            {{-- penting: input file TIDAK boleh ada :value --}}
                            <input type="file" name="file_project" accept="application/pdf"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none
                          file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-2 hover:file:bg-slate-200
                          dark:bg-gray-700 dark:border-gray-600" />
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="openModalUpdateProject=false"
                                class="rounded-lg bg-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-300 dark:bg-gray-700 dark:text-gray-200">
                                Batal
                            </button>
                            <button type="submit"
                                class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ================= (Optional) MODAL: DELETE ================= --}}
        <div x-cloak x-show="openModalDeleteProject" x-transition class="fixed inset-0 z-50" role="dialog"
            aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="openModalDeleteProject=false"></div>

            <div class="relative mx-auto my-8 w-full max-w-md px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6 text-center">
                    <button @click="openModalDeleteProject=false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <svg class="mx-auto mb-3.5 h-11 w-11 text-slate-400 dark:text-gray-500" aria-hidden="true"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 1 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 1 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-slate-600 dark:text-gray-300">Apakah kamu yakin ingin menghapus project ini?
                    </p>
                    <form action="{{ route('admin.delete.project') }}" method="POST"
                        class="flex justify-center gap-3">
                        @csrf
                        <input type="hidden" name="id" :value="idProject" />
                        <button type="button" @click="openModalDeleteProject=false"
                            class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            Tidak
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                            Ya, hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
