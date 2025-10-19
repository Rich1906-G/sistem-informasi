<x-layout-mahasiswa>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:header>{{ $header }}</x-slot:header>

    <div x-data="{
        deleteAll: false,
        hapus1Data: false,
        noHapus: 0,
        dropDownLaptop: false,
        dropDownHp: false,
        showProject: false,
        namaTugas: '',
        formUploadTugas: false,
        formUpdateTugas: false,
        idTugas: null,
        idProject: null,
        detailTugas: [],
    }" class="mx-auto w-full max-w-screen-7xl px-4 sm:px-6 md:px-2 py-6">
        <section
            class="bg-white dark:bg-gray-800 shadow-lg ring-1 ring-slate-200/70 dark:ring-gray-700 rounded-2xl overflow-hidden">

            {{-- ===== Toolbar ===== --}}
            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-4 sm:p-6 border-b border-slate-200/70 dark:border-gray-700">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-slate-900 dark:text-white">Daftar Tugas</h1>
                    <p class="text-sm text-slate-500 dark:text-gray-300">Kelola & lihat detail project tugas kamu.</p>
                </div>

                <form action="#" method="GET" class="w-full md:w-auto">
                    <div class="relative">
                        <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-500"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m21 21-3.5-3.5" />
                            <circle cx="10" cy="10" r="7" />
                        </svg>
                        <input id="search" name="search" autocomplete="off" placeholder="Cari data tugas…"
                            type="search"
                            class="w-full md:w-80 rounded-xl border border-slate-300 bg-white pl-10 pr-3 py-2.5 text-sm text-slate-900
                                   outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                   dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                        @if (request('search'))
                            <a href="{{ url()->current() }}"
                                class="absolute right-2 top-1/2 -translate-y-1/2 text-xs px-2 py-1 rounded-md bg-slate-100 text-slate-600 hover:bg-slate-200">
                                Clear
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            {{-- ===== Desktop Table ===== --}}
            <div class="hidden md:block p-4 sm:p-6">
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-gray-700">
                    <table class="min-w-full text-sm">
                        <thead
                            class="sticky top-0 bg-slate-50 dark:bg-gray-700 text-slate-700 dark:text-gray-200 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 text-center w-16">No</th>
                                <th class="px-4 py-3 text-left">Nama Tugas</th>
                                <th class="px-4 py-3 text-center w-64">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                            @foreach ($dataTugas as $tugas)
                                <tr
                                    class="odd:bg-white even:bg-slate-50 dark:odd:bg-gray-800 dark:even:bg-gray-800/70 hover:bg-slate-50 dark:hover:bg-gray-700/60">
                                    <td class="px-4 py-3 text-center">
                                        {{ $dataTugas->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-slate-900 dark:text-gray-100">
                                        {{ $tugas->nama_tugas ?? 'Tidak ada tugas' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center justify-center">
                                            <a href="{{ route('mahasiswa.project', $tugas->slug) }}"
                                                class="inline-flex items-center gap-2 rounded-lg bg-amber-600 px-3 py-2 text-white hover:bg-amber-700 focus:ring-4 focus:ring-amber-300">
                                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path d="m21 21-6-6" />
                                                    <circle cx="11" cy="11" r="8" />
                                                </svg>
                                                Lihat Detail Project
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            @if ($dataTugas->isEmpty())
                                <tr>
                                    <td colspan="3" class="px-4 py-12 text-center text-slate-500 dark:text-gray-300">
                                        Belum ada tugas. Tenang, bukan kamu doang kok. 😉
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $dataTugas->links() }}
                </div>
            </div>

            {{-- ===== Mobile Cards ===== --}}
            <div class="md:hidden p-4 sm:p-6 space-y-3">
                @foreach ($dataTugas as $tugas)
                    <div
                        class="rounded-2xl border border-slate-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-4 shadow-sm">
                        <p class="text-xs text-slate-500 dark:text-gray-400">
                            #{{ $dataTugas->firstItem() + $loop->index }}</p>
                        <h3 class="mt-1 text-base font-semibold text-slate-900 dark:text-white">
                            {{ $tugas->nama_tugas ?? 'Tidak ada tugas' }}
                        </h3>
                        <div class="mt-3">
                            <a href="{{ route('mahasiswa.project', $tugas->slug) }}"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-amber-600 px-3 py-2 text-sm font-medium text-white hover:bg-amber-700 focus:ring-4 focus:ring-amber-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="m21 21-6-6" />
                                    <circle cx="11" cy="11" r="8" />
                                </svg>
                                Lihat Detail Project
                            </a>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    {{ $dataTugas->links() }}
                </div>
            </div>
        </section>

        {{-- ===================== MODAL: DETAIL PROJECT (showProject) ===================== --}}
        <div x-cloak x-show="showProject" x-transition class="fixed inset-0 z-50" role="dialog" aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="showProject = false"></div>

            <div class="relative mx-auto my-8 w-full max-w-5xl px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700">
                    <button @click="showProject = false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="px-5 pt-5 pb-4 sm:px-6">
                        <h2 class="text-lg font-semibold text-slate-900 dark:text-white text-center" x-text="namaTugas">
                        </h2>
                    </div>

                    <div class="px-4 pb-5 sm:px-6">
                        <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-gray-700">
                            <table class="min-w-full text-sm">
                                <thead
                                    class="bg-slate-50 dark:bg-gray-700 text-slate-700 dark:text-gray-200 text-xs uppercase">
                                    <tr>
                                        <th class="px-4 py-3 text-center w-16">No</th>
                                        <th class="px-4 py-3 text-left">Nama Project</th>
                                        <th class="px-4 py-3 text-left">Nama File Project</th>
                                        <th class="px-4 py-3 text-left">File Project</th>
                                        <th class="px-4 py-3 text-left">Status</th>
                                        <th class="px-4 py-3 text-center w-64">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-gray-700">
                                    <template x-for="(projects, index) in detailTugas" :key="projects.id">
                                        <tr
                                            class="odd:bg-white even:bg-slate-50 dark:odd:bg-gray-800 dark:even:bg-gray-800/70">
                                            <td class="px-4 py-3 text-center" x-text="index + 1"></td>
                                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-gray-100"
                                                x-text="projects.nama_project"></td>
                                            <td class="px-4 py-3" x-text="projects.nama_file_project"></td>
                                            <td class="px-4 py-3" x-text="projects.file_project"></td>
                                            <td class="px-4 py-3" x-text="projects.status"></td>
                                            <td class="px-4 py-3">
                                                <div class="grid gap-2 sm:grid-cols-3">
                                                    <button @click="formUploadTugas = true; idProject = projects"
                                                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-green-600 px-3 py-2 text-white hover:bg-green-700 focus:ring-4 focus:ring-green-300">
                                                        Upload
                                                    </button>
                                                    <button @click="formUpdateTugas = true; idProject = projects"
                                                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-amber-500 px-3 py-2 text-white hover:bg-amber-600 focus:ring-4 focus:ring-amber-300">
                                                        Edit
                                                    </button>
                                                    <button
                                                        class="inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-3 py-2 text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===================== MODAL: DELETE ALL ===================== --}}
        <div x-cloak x-show="deleteAll" x-transition class="fixed inset-0 z-50" role="dialog" aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="deleteAll = false"></div>

            <div class="relative mx-auto my-8 w-full max-w-md px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6 text-center">
                    <button @click="deleteAll = false"
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
                            d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 1 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9zM7 8a1 1 0 0 1 2 0v6a1 1 0 1 1-2 0V8zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4 text-slate-600 dark:text-gray-300">Yakin hapus semua data?</p>
                    <div class="flex justify-center items-center gap-3">
                        <button @click="deleteAll = false" type="button"
                            class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            Batal
                        </button>
                        <button type="submit" @click="deleteAll = false"
                            class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                            Ya, hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: DELETE ONE ===================== --}}
        <div x-cloak x-show="hapus1Data" x-transition class="fixed inset-0 z-50" role="dialog" aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="hapus1Data = false"></div>

            <div class="relative mx-auto my-8 w-full max-w-md px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6 text-center">
                    <button @click="hapus1Data = false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <form x-bind:action="'/contract/' + noHapus" method="POST">
                        @csrf
                        @method('DELETE')

                        <svg class="mx-auto mb-3.5 h-11 w-11 text-slate-400 dark:text-gray-500" aria-hidden="true"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 0 0-.894.553L7.382 4H4a1 1 0 0 0 0 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6a1 1 0 1 0 0-2h-3.382l-.724-1.447A1 1 0 0 0 11 2H9zM7 8a1 1 0 0 1 2 0v6a1 1 0 1 1-2 0V8zm5-1a1 1 0 0 0-1 1v6a1 1 0 1 0 2 0V8a1 1 0 0 0-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="mb-4 text-slate-600 dark:text-gray-300">Yakin hapus data ini?</p>

                        <div class="flex justify-center items-center gap-3">
                            <button @click="hapus1Data = false" type="button"
                                class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm text-slate-700 hover:bg-slate-50 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                                Batal
                            </button>
                            <button type="submit" @click="hapus1Data = false"
                                class="rounded-lg bg-red-600 px-3 py-2 text-sm text-white hover:bg-red-700 focus:ring-4 focus:ring-red-300">
                                Ya, hapus
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- ===================== MODAL: UPLOAD PROJECT ===================== --}}
        <div x-cloak x-show="formUploadTugas" x-transition class="fixed inset-0 z-50" role="dialog"
            aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="formUploadTugas = false"></div>

            <div class="relative mx-auto my-8 w-full max-w-2xl px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6">
                    <button @click="formUploadTugas = false"
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
                        <input type="hidden" name="project_id" :value="idProject?.id">

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama Project</label>
                            <input type="text" name="nama_project" readonly :value="idProject?.nama_project"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama File Project</label>
                            <input type="text" name="nama_file_project"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">File Project (PDF)</label>
                            <input type="file" name="file_project" accept="application/pdf"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-2 hover:file:bg-slate-200 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="formUploadTugas = false"
                                class="rounded-lg bg-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
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

        {{-- ===================== MODAL: UPDATE PROJECT ===================== --}}
        <div x-cloak x-show="formUpdateTugas" x-transition class="fixed inset-0 z-50" role="dialog"
            aria-modal="true">
            <div class="absolute inset-0 bg-black/50" @click="formUpdateTugas = false"></div>

            <div class="relative mx-auto my-8 w-full max-w-2xl px-4">
                <div
                    class="relative rounded-2xl bg-white dark:bg-gray-800 shadow-xl ring-1 ring-slate-200 dark:ring-gray-700 p-5 sm:p-6">
                    <button @click="formUpdateTugas = false"
                        class="absolute top-3 right-3 p-2 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-gray-700 dark:hover:bg-gray-600"
                        aria-label="Tutup modal">
                        <svg class="h-5 w-5 text-slate-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2">
                            <path d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    <h2 class="text-xl font-bold mb-4 text-slate-900 dark:text-white">Update Project</h2>

                    <form action="{{ route('mahasiswa.update.project') }}" method="POST"
                        enctype="multipart/form-data" class="grid gap-4">
                        @csrf
                        <input type="hidden" name="tugas_id" :value="idTugas">
                        <input type="hidden" name="project_id" :value="idProject?.id">

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama Project</label>
                            <input type="text" name="nama_project" readonly :value="idProject?.nama_project"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Nama File Project</label>
                            <input type="text" name="nama_file_project" :value="idProject?.nama_file_project"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium">Ganti File Project (PDF)</label>
                            {{-- ⚠️ file input TIDAK boleh ada :value --}}
                            <input type="file" name="file_project" accept="application/pdf"
                                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-2 hover:file:bg-slate-200 dark:bg-gray-700 dark:border-gray-600">
                        </div>

                        <div class="flex justify-end gap-2">
                            <button type="button" @click="formUpdateTugas = false"
                                class="rounded-lg bg-slate-200 px-4 py-2 text-slate-700 hover:bg-slate-300 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
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

    </div>
</x-layout-mahasiswa>
