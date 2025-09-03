<x-layout-mahasiswa>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>



    <div class="w-full p-4 flex ">
        <div class="w-full bg-white shadow-md flex p-4 rounded-md">
            {{-- <div class="">Testing</div> --}}
            <h1 class="text-xl font-semibold">Selamat Datang ~ {{ $data_mahasiswa->nama_mahasiswa }}</h1>
        </div>
    </div>

    <!-- Card Example -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 xl:my-4 xl:mx-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Data Mahasiswa</h2>
            <p>Kelola informasi mahasiswa di sini.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Tugas</h2>
            <p>Kelola tugas mahasiswa di sini.</p>
        </div>
    </div>
</x-layout-mahasiswa>
