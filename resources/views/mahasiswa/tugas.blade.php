<x-layout-mahasiswa>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>

    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg relative md:mx-4 lg:mx-4 xl:my-8 xl:mx-4"
        x-data="{
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
        }">
        <div class="flex flex-col items-center p-4 md:flex-row md:space-y-0 lg:justify-between">

            <div class="w-full md:w-full lg:w-1/2">
                <form action="#" method="GET">
                    <div
                        class="items-center mx-auto space-y-4 max-w-screen-sm sm:flex sm:space-y-0 lg:mb-0    lg:mx-0 lg:max-w-screen-lg">
                        <div class="relative w-full">
                            <label for="search"
                                class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Search</label>
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white " aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>

                            <input autocomplete="off" type="text"
                                class="block p-3 pl-10 w-full text-sm md:block md:w-full text-gray-900 
                                          bg-gray-50 rounded-lg border border-gray-300 sm:rounded-none 
                                          sm:rounded-l-lg  focus:ring-blue-500 focus:border-blue-500 
                                          dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 
                                          dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cara Data Tugas" type="search" id="search" name="search">
                        </div>
                        <div>
                            <button type="submit"
                                class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-blue-700 border-blue-600 sm:rounded-none sm:rounded-r-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="overflow-auto lg:my-2 ">
            <table class="w-full md:w-full md:text-sm text-center  text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="">
                        <th class="px-4 py-3 lg:py-4 ">No</th>
                        <th class="px-4 py-3 lg:py-4 ">Nama Tugas</th>
                        {{-- <th class="px-4 py-3 lg:py-4 ">Status</th> --}}
                        <th scope="col" class="text-center mx-4 py-3 lg:py-4 ">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataTugas as $tugas)
                        <tr class="xl:text-base">
                            <td class="px-4 py-3 lg:p-4">{{ $dataTugas->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 lg:p-4">
                                {{ $tugas->nama_tugas ?? 'Tidak ada tugas' }}
                            </td>
                            {{-- <td class="px-4 py-3 lg:py-4"></td> --}}
                            <td class="px-4 py-3 lg:py-4 text-center">
                                <a href="{{ route('mahasiswa.project', $tugas->slug) }}"
                                    class="inline-flex items-center justify-center w-44 py-2 px-3 bg-amber-500 text-white rounded-lg hover:bg-amber-600 focus:ring-4 focus:ring-amber-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                        width="24px" fill="#FFFFFF">
                                        <path
                                            d="M480-120q-75 0-140.5-28.5t-114-77q-48.5-48.5-77-114T120-480q0-75 28.5-140.5t77-114q48.5-48.5 114-77T480-840q82 0 155.5 35T760-706v-94h80v240H600v-80h110q-41-56-101-88t-129-32q-117 0-198.5 81.5T200-480q0 117 81.5 198.5T480-200q105 0 183.5-68T756-440h82q-15 137-117.5 228.5T480-120Zm112-192L440-464v-216h80v184l128 128-56 56Z" />
                                    </svg>
                                    <span>Lihat Detail Project</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div x-cloak x-show="showProject" x-transition
            class="bg-black/50 fixed top-0 left-0 h-screen w-full flex justify-center items-center overflow-auto">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800">
                <div class="flex items-center justify-center py-3">
                    <span class="text-xl font-semibold" x-text="namaTugas"></span>
                </div>

                <div class="overflow-auto lg:my-2 rounded-lg shadow-lg">
                    <table class="w-full md:w-full md:text-sm text-center text-gray-500 dark:text-gray-400 ">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="">
                                <th class="px-4 py-3 lg:py-4 ">No</th>
                                <th class="px-4 py-3 lg:py-4 ">Nama Project</th>
                                <th class="px-4 py-3 lg:py-4">Nama File Project</th>
                                <th class="px-4 py-3 lg:py-4">File Project</th>
                                <th class="px-4 py-3 lg:p-4">Status</th>
                                <th class="px-4 py-3 lg:py-4 ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for="(projects, index) in detailTugas" :key="projects.id">
                                <tr class="xl:text-base">
                                    <td class="px-4 py-3 lg:py-4" x-text="index + 1"></td>
                                    <td class="px-4 py-3 lg:py-4" x-text="projects.nama_project"></td>
                                    <td class="px-4 py-3 lg:py-4" x-text="projects.nama_file_project"></td>
                                    <td class="px-4 py-3 lg:p-4" x-text="projects.file_project">Test
                                    </td>
                                    <td class="px-4 py-3 lg:p-4" x-text="projects.status"></td>
                                    <td class="px-4 py-3 lg:py-4 grid gap-4" x-data="{ filename: '' }">
                                        <!-- Button Upload -->
                                        <button @click="formUploadTugas = !formUploadTugas;  idProject = projects"
                                            class="flex items-center justify-between gap-2 bg-green-500 hover:bg-green-600 px-5 py-2.5 rounded-md text-white">
                                            <span>Upload Project</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                                <path
                                                    d="M440-200h80v-167l64 64 56-57-160-160-160 160 57 56 63-63v167ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
                                            </svg>
                                        </button>

                                        <button @click="formUpdateTugas = !formUpdateTugas; idProject = projects"
                                            class="flex items-center justify-between bg-orange-400 hover:bg-orange-500 px-5 py-2.5 gap-2 rounded-md text-white">
                                            <span>Edit Project</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                                <path
                                                    d="M560-80v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-300L683-80H560Zm300-263-37-37 37 37ZM620-140h38l121-122-18-19-19-18-122 121v38ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v120h-80v-80H520v-200H240v640h240v80H240Zm280-400Zm241 199-19-18 37 37-18-19Z" />
                                            </svg>
                                        </button>


                                        <button
                                            class="flex items-center justify-between gap-2 px-5 py-2.5 bg-red-500 hover:bg-red-600 rounded-md text-white">
                                            <span>Hapus Project</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" height="24px"
                                                viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                                                <path
                                                    d="M240-800v200-200 640-9.5 9.5-640Zm0 720q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v174q-19-7-39-10.5t-41-3.5v-120H520v-200H240v640h254q8 23 20 43t28 37H240Zm396-20-56-56 84-84-84-84 56-56 84 84 84-84 56 56-83 84 83 84-56 56-84-83-84 83Z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                <button @click="showProject = false" type="button"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
        </div>


        <div x-cloak x-show="deleteAll" x-transition
            class="bg-black/50 fixed top-0 left-0 h-screen w-full flex justify-center items-center">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button @click="deleteAll = false" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete all data?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="deleteAll = false" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button type="submit" @click="deleteAll = false"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div x-cloak x-show="hapus1Data" x-transition
            class="bg-black/50 fixed top-0 left-0 h-screen w-full flex justify-center items-center">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <form x-bind:action="'/contract/' + noHapus" method="POST">
                    @csrf
                    @method('DELETE')
                    <button @click="hapus1Data = false" type="button"
                        class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                        fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete all data?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="hapus1Data = false" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            No, cancel
                        </button>
                        <button type="submit" @click="hapus1Data = false"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes, I'm sure
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Form Upload (muncul kalau diklik) -->
        <div x-show="formUploadTugas" class="fixed inset-0 bg-black/50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-[700px]">
                <h2 class="text-xl font-bold mb-4">Upload Project</h2>

                <form action="{{ route('mahasiswa.upload.project') }}" method="POST" enctype="multipart/form-data"
                    class="grid gap-4">
                    @csrf

                    <input type="hidden" name="tugas_id" :value="idTugas">
                    <input type="hidden" name="project_id" :value="idProject?.id">

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Nama
                            Project</label>
                        <input type="text" name="nama_project" readonly :value="idProject?.nama_project"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Nama File
                            Project</label>
                        <input type="text" name="nama_file_project"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">File
                            Project</label>
                        <input type="file" name="file_project" accept="application/pdf"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="formUploadTugas = false"
                            class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="formUpdateTugas" class="fixed inset-0 bg-black/50 flex items-center justify-center">
            <div class="bg-white p-6 rounded-lg w-[700px]">
                <h2 class="text-xl font-bold mb-4">Update Project</h2>

                <form action="{{ route('mahasiswa.update.project') }}" method="POST" enctype="multipart/form-data"
                    class="grid gap-4">
                    @csrf

                    <input type="hidden" name="tugas_id" :value="idTugas">
                    <input type="hidden" name="project_id" :value="idProject?.id">

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Nama
                            Project</label>
                        <input type="text" name="nama_project" readonly :value="idProject?.nama_project"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">Nama File Project</label>
                        <input type="text" name="nama_file_project" :value="idProject?.nama_file_project"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium">File Project</label>
                        <input type="file" name="file_project" accept="application/pdf"
                            :value="idProject?.nama_file_project"
                            class="w-full border rounded px-3 py-2 focus:outline-none focus:ring">
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="formUpdateTugas = false"
                            class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded">
                            Batal
                        </button>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                            Upload
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-layout-mahasiswa>
