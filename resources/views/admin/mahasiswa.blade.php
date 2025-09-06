<x-layout>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>

    <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg relative md:mx-4 lg:mx-4 xl:my-8 xl:mx-4"
        x-data="{ deleteAll: false, hapus1Data: false, noHapus: 0, dropDownLaptop: false, dropDownHp: false }">
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
                <form action="{{ route('admin.cari_data_mahasiswa') }}" method="GET">
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
                                placeholder="Cari Data Mahasiswa" type="search" id="search" name="search">
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
                        <th class="px-4 py-3 lg:py-4 ">No Hanphone</th>
                        <th class="px-4 py-3 lg:py-4 ">Pas Foto</th>
                        <th scope="col" class="text-center mx-4 py-3 lg:py-4 ">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_mahasiswa as $mahasiswa)
                        <tr class="xl:text-base">
                            <td class="px-4 py-3 lg:py-4">{{ $data_mahasiswa->firstItem() + $loop->index }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $mahasiswa->nama_mahasiswa }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $mahasiswa->nim }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $mahasiswa->semester }}</td>
                            <td class="px-4 py-3 lg:py-4">{{ $mahasiswa->no_hp }}</td>
                            <td class="flex-space-x-0 overflow-hidden">
                                <img src="{{ asset($mahasiswa->pas_foto) }}"
                                    class="inline-block size-20 rounded-full ring-2 ring-white outline -outline-offset-1 outline-black/5"></img>
                            </td>
                            <td class="px-4 py-3 lg:py-4 w-auto">
                                <a href="#"
                                    class="flex items-center text-white justify-center bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-md lg:rounded-md text-sm px-5 py-2.5 md:px-3 md:py-2 text-center  md:me-0 mb-2 dark:focus:ring-yellow-900  md:items-center md:w-4/5 md:mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="20" width="20"
                                        viewBox="0 0 576 512" class="size-6 mr-2">
                                        <path fill="#ffffff"
                                            d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z" />
                                    </svg> Edit
                                </a>
                                <button type="button"
                                    @click="hapus1Data = ! hapus1Data ; noHapus='{{ $mahasiswa->contr_id }}';"
                                    class="flex items-center text-white justify-center bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-md text-sm px-5 py-2.5 md:px-3 md:py-2 text-center md:me-4 mb-2 dark:focus:ring-yellow-900 md:w-4/5 md:mx-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6 mr-2">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $data_mahasiswa->links() }}

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
    </div>
</x-layout>
