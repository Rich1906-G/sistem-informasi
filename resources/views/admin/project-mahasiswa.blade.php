<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-title>{{ $title }}</x-title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>
    <div x-data="{
        openModalSetujuiProject: false,
        openModalMenolakProject: false,
        idTugas: '',
        idMahasiswa: '',
    }" class="flex max-w-7xl mx-auto p-4  items-center justify-center">
        <div class=" grid gap-4 w-full py-8">
            <div class="flex items-center justify-center">
                {{-- <label class="font-bold text-2xl font-sans">Detail Project</label> --}}
                <h2 class="font-bold text-2xl font-sans">Detail Tugas : {{ $tugas->nama_tugas }}</h2>
            </div>

            <div class="flex flex-col items-center py-4 md:flex-row md:space-y-0 lg:justify-between gap-4">
                <div class="flex gap-4 ">
                    <button type="button"
                        @click="openModalSetujuiProject = !openModalSetujuiProject; idTugas={{ $tugas->id }}; idMahasiswa={{ $mahasiswaId }};"
                        class="flex items-center gap-2 justify-center px-5 py-2.5 bg-green-700 text-white rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium text-sm dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 w-full">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#FFFFFF">
                            <path
                                d="m381-240 424-424-57-56-368 367-169-170-57 57 227 226Zm0 113L42-466l169-170 170 170 366-367 172 168-538 538Z" />
                        </svg>
                        <span class="inline-flex">Setujui</span>
                    </button>

                    <button type="button"
                        @click="openModalMenolakProject = !openModalMenolakProject; idTugas={{ $tugas->id }}; idMahasiswa={{ $mahasiswaId }};"
                        class="py-3 px-6 bg-red-500 text-white rounded-lg flex items-center justify-center gap-4 hover:bg-red-600 focus:ring-4 focus:ring-red-300">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                            fill="#FFFFFF">
                            <path
                                d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z" />
                        </svg>
                        <span>Tolak</span>
                    </button>
                </div>
                <div class="w-full md:w-full lg:w-1/2 ">
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
                                    placeholder="Cara Data" type="search" id="search" name="search">
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

            <div class="overflow-auto lg:my-2 rounded-lg shadow-slate-300 shadow-xl">
                <table class="w-full md:w-full md:text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="">
                            <th class="px-4 py-3 lg:p-4 ">No</th>
                            <th class="px-4 py-3 lg:p-4 ">Nama Project</th>
                            <th class="px-4 py-3 lg:p-4 ">Nama File Project</th>
                            <th class="px-4 py-3 lg:p-4 ">File Project</th>
                            <th class="px-4 py-3 lg:p-4 ">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($dataMahasiswa as $mahasiswa)
                            @foreach ($mahasiswa->project as $project)
                                <tr class="xl:text-base">
                                    <td class="px-4 py-3 lg:px-8">{{ $no++ }}</td>
                                    <td class="px-4 py-3 lg:py-4 text-center">
                                        {{ $project->nama_project }}
                                    </td>
                                    <td class="px-4 py-3 lg:p-4">
                                        {{ $project->nama_file_project ?? 'Tidak Ada' }}
                                    </td>
                                    <td class="px-4 py-3 lg:p-4">
                                        @if ($project->file_project)
                                            <a href="{{ asset('storage/' . $project->file_project) }}" target="_blank"
                                                class="text-blue-600 hover:underline">
                                                Lihat File
                                            </a>
                                        @else
                                            <span class="text-gray-400 italic">Belum ada file</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 lg:p-4 text-center">
                                        {{ optional($mahasiswa->tugas->first())->pivot->status ?? 'Belum Ada' }}
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $dataMahasiswa->links() }}

            <div class="flex items-center justify-end mt-5">
                <a href="{{ route('admin.tugas.mahasiswa') }}"
                    class="p-4 bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 rounded-lg text-white">
                    Kembali
                </a>
            </div>
        </div>

        <!-- Modal Setujui Tugas -->
        <div x-show="openModalSetujuiProject" x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center overflow-y-auto overflow-x-hidden w-full">
            <form action="{{ route('admin.setujui.tugas') }}" method="post">
                @csrf
                <input type="text" class="hidden" name="tugas_id" :value=idTugas></input>
                <input type="text" class="hidden" name="mahasiswa_id" :value=idMahasiswa></input>
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <button type="button" @click="openModalSetujuiProject = false"
                            class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="deleteModal">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="m381-240 424-424-57-56-368 367-169-170-57 57 227 226Zm0 113L42-466l169-170 170 170 366-367 172 168-538 538Z" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                        <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin untuk menyetujui project
                            ini??
                        </p>
                        <div class="flex justify-center items-center space-x-4">
                            <button @click="openModalSetujuiProject = false" type="button"
                                class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Tidak
                            </button>
                            <button type="submit"
                                class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                Ya, saya yakin
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Setujui Tugas -->
        <div x-show="openModalMenolakProject" x-cloak
            class="fixed inset-0 bg-black/50 flex items-center justify-center overflow-y-auto overflow-x-hidden w-full">
            <form action="{{ route('admin.tolak.tugas') }}" method="post">
                @csrf
                <input type="text" class="hidden" name="tugas_id" :value=idTugas></input>
                <input type="text" class="hidden" name="mahasiswa_id" :value=idMahasiswa></input>
                <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                    <!-- Modal content -->
                    <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <button type="button" @click="openModalMenolakProject = false"
                            class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-toggle="deleteModal">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960"
                                width="24px" fill="#FFFFFF">
                                <path
                                    d="m381-240 424-424-57-56-368 367-169-170-57 57 227 226Zm0 113L42-466l169-170 170 170 366-367 172 168-538 538Z" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>

                        <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd">
                            </path>
                        </svg>
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin untuk menyetujui project
                            ini??
                        </p>
                        <div class="flex justify-center items-center space-x-4">
                            <button @click="openModalMenolakProject = false" type="button"
                                class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                Tidak
                            </button>
                            <button type="submit"
                                class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                Ya, saya yakin
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
