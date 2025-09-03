<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>

    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg relative md:mx-4 lg:mx-4 xl:my-8 xl:mx-4"
        x-data="{
            deleteAll: false,
            dropDownLaptop: false,
            dropDownHp: false,
            setujui: false,
            idTugas: null,
            tidakDisetujui: false,
        }">
        <div class="flex flex-col items-center p-4 md:flex-row md:space-y-0 lg:justify-between">

            {{-- Dropdown Laptop s/d PC --}}
            <div class="hidden lg:inline lg:w-auto">
                <button @click="dropDownLaptop = !dropDownLaptop"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    Action Menu
                    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>

                <!-- Dropdown menu -->
                <div x-show="dropDownLaptop" @click.away="dropDownLaptop = false" x-cloak
                    class="z-auto absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href='#'
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add
                                Data Contract</a>
                        </li>
                        <li>
                            <form action='#' method="POST" enctype="multipart/form-data"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white cursor-pointer"
                                id="uploadFile">
                                @csrf
                                <label style="cursor:pointer">Import Data
                                    <input id="fileInput" name="excel_file" type="file" class="hidden"
                                        onchange="handleFileUpload()" />
                                </label>
                            </form>
                            <script>
                                function handleFileUpload() {
                                    const fileInput = document.getElementById('fileInput');
                                    if (fileInput.files.length > 0) {
                                        document.getElementById('uploadFile').submit();
                                    }
                                }
                            </script>
                        </li>
                        <li>
                            <form action="'#'" method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="submit" @click="side = false"
                                    class="w-full flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                    Data
                                </button>
                            </form>
                        </li>
                        <li>
                            <button type="button" @click="deleteAll = ! deleteAll; dropDownLaptop = false"
                                class="w-full flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                All Data</button>
                        </li>
                    </ul>
                </div>
            </div>

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

        {{-- Dropdown Hp s/d md --}}
        <div class="md:flex md:items-end justify-end ">
            <div class="w-full flex flex-col items-center p-4 md:w-48 md:mx-2 lg:hidden">
                <button @click="dropDownHp = !dropDownHp"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                    <label class="flex items-center justify-center"> Action
                        Menu <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></label>
                </button>

                <!-- DropdownHP menu -->
                <div x-show="dropDownHp" @click.away="dropDownHp = false" x-cloak
                    class="z-auto absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropDownHandphone">
                        <li>
                            <a href='#'
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add
                                Data Contract</a>
                        </li>
                        <li>
                            <form action='#' method="POST" enctype="multipart/form-data"
                                class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                style="cursor:pointer" id="uploadFile">
                                @csrf
                                <label style="cursor:pointer">Import Data
                                    <input id="fileInput" name="excel_file" type="file" class="hidden"
                                        onchange="handleFileUpload()" />
                                </label>
                            </form>
                            <script>
                                function handleFileUpload() {
                                    const fileInput = document.getElementById('fileInput');
                                    if (fileInput.files.length > 0) {
                                        document.getElementById('uploadFile').submit();
                                    }
                                }
                            </script>
                        </li>
                        <li>
                            <form action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Export
                                    Data
                                </button>
                            </form>
                        </li>
                        <li>
                            <button type="button" @click="deleteAll = ! deleteAll; dropDownHp = false"
                                class="w-full flex px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete
                                All Data</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="overflow-auto lg:my-2 ">
            <table class="w-full md:w-full md:text-sm text-center  text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr class="">
                        <th class="px-4 py-3 lg:py-4 ">No</th>
                        <th class="px-4 py-3 lg:py-4 ">Nama Mahasiswa</th>
                        <th class="p-px-4 py-3 lg:py-4 ">NIM</th>
                        <th class="px-4 py-3 lg:py-4 ">Semester</th>
                        <th class="px-4 py-3 lg:py-4 ">Nama Tugas</th>
                        <th class="px-4 py-3 lg:py-4 ">File Tugas</th>
                        <th class="px-4 py-3 lg:py-4 ">Status</th>
                        <th scope="col" class="text-center mx-4 py-3 lg:py-4 ">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_tugas as $tugas)
                        <tr class="xl:text-base">
                            <td class="px-4 py-3 lg:py-4">{{ $data_tugas->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $tugas->mahasiswa->nama_mahasiswa }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $tugas->mahasiswa->nim }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $tugas->mahasiswa->semester }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $tugas->nama_tugas }}</td>
                            <td class="px-4 py-3 lg:py-4">
                                @php
                                    $filePath = asset($tugas->file_tugas);
                                    $fileExtension = pathinfo($tugas->file_tugas, PATHINFO_EXTENSION); // Ambil ekstensi file
                                @endphp

                                @if ($fileExtension === 'pdf')
                                    <embed src="{{ $filePath }}" type="application/pdf" class="w-40 h-40">
                                @elseif (in_array($fileExtension, ['doc', 'docx', 'ppt', 'pptx', 'xls', 'xlsx']))
                                    <a href="{{ $filePath }}" target="_blank"
                                        class="flex items-center justify-center space-x-2">
                                        <img src="{{ asset('storage/icons/file-icon.png') }}" alt="File Document"
                                            class="w-10 h-10 ">
                                        <span>Download File</span>
                                    </a>
                                @else
                                    <a href="{{ $filePath }}" target="_blank" class="text-blue-500">Download
                                        File</a>
                                @endif
                            </td>
                            <td class="px-4 py-3 lg:py-4">
                                {{ $tugas->status }}
                            </td>
                            <td class="px-4 py-3 lg:py-4 w-auto">
                                <button type="button" @click="setujui = ! setujui ; idTugas='{{ $tugas->id }}';"
                                    class="flex items-center text-white justify-center bg-green-400 hover:bg-green-500 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-md lg:rounded-md text-sm px-5 py-2.5 md:px-3 md:py-2 text-center  md:me-0 mb-2 dark:focus:ring-green-900  md:items-center md:w-4/5 md:mx-4 space-x-2">
                                    <svg height="20" width="20" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                            stroke="#CCCCCC" stroke-width="0.288"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path d="M4 12.6111L8.92308 17.5L20 6.5" stroke="#000000" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                        </g>
                                        <span>Setujui</span>
                                    </svg>
                                </button>
                                <button type="button"
                                    @click="tidakDisetujui = ! tidakDisetujui ; idTugas='{{ $tugas->id }}';"
                                    class="flex items-center text-white justify-center bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 md:px-3 md:py-2 text-center md:me-4 mb-2 dark:focus:ring-yellow-900 md:w-4/5 md:mx-4 space-x-2">
                                    <svg fill="#000000" height="20" width="20" viewBox="0 0 200 200"
                                        data-name="Layer 1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        stroke="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round">
                                        </g>
                                        <g id="SVGRepo_iconCarrier">
                                            <title></title>
                                            <path
                                                d="M114,100l49-49a9.9,9.9,0,0,0-14-14L100,86,51,37A9.9,9.9,0,0,0,37,51l49,49L37,149a9.9,9.9,0,0,0,14,14l49-49,49,49a9.9,9.9,0,0,0,14-14Z">
                                            </path>
                                        </g>
                                        <span>Tolak<span>
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data_tugas->links() }}

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

        <div x-cloak x-show="setujui" x-transition
            class="bg-black/50 fixed top-0 left-0 h-screen w-full flex justify-center items-center">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <form x-bind:action="'/admin/ubah_status_tugas_mahasiswa/' + idTugas" method="POST">
                    @csrf
                    <button @click="setujui = false" type="button"
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
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin untuk menyetujui tugas ini?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="setujui = false" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Tidak
                        </button>
                        <button type="submit" @click="setujui = false"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Ya
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div x-cloak x-show="tidakDisetujui" x-transition
            class="bg-black/50 fixed top-0 left-0 h-screen w-full flex justify-center items-center">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <form x-bind:action="'/admin/ubah_status_tugas_mahasiswa/' + idTugas" method="POST">
                    @csrf
                    <button @click="tidakDisetujui = false" type="button"
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
                    <p class="mb-4 text-gray-500 dark:text-gray-300">Apakah anda yakin untuk menolak tugas ini?</p>
                    <div class="flex justify-center items-center space-x-4">
                        <button @click="tidakDisetujui = false" type="button"
                            class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Tidak
                        </button>
                        <button type="submit" @click="tidakDisetujui = false"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Ya
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
