<x-layout-mahasiswa>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>


    <div class="max-w-5xl mx-auto mt-10 bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-900 px-6 py-4">
            <h2 class="text-2xl font-bold text-white">Data Pribadi Mahasiswa</h2>
        </div>

        <!-- Content -->
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Foto Mahasiswa -->
                <div class="flex-shrink-0 flex justify-center md:justify-start">
                    <img src="{{ asset($data_mahasiswa->pas_foto) }}" alt="Pas Foto"
                        class="w-40 h-52 object-cover rounded-lg shadow-md border-2 border-gray-200" />
                </div>

                <!-- Biodata -->
                <div class="flex-1">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $data_mahasiswa->nama_mahasiswa }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">NIM</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $data_mahasiswa->nim }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Semester</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $data_mahasiswa->semester }}
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Nomor HP</dt>
                            <dd class="mt-1 text-lg font-semibold text-gray-800">
                                {{ $data_mahasiswa->no_hp }}
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200 my-6"></div>

            <!-- Extra Info (jika mau tambah field lain) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $data_mahasiswa->alamat ?? '-' }}
                    </dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Email</dt>
                    <dd class="mt-1 text-base text-gray-700">
                        {{ $data_mahasiswa->email ?? '-' }}
                    </dd>
                </div>
            </div>
        </div>
    </div>

</x-layout-mahasiswa>
