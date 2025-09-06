<x-layout-prodi>
    <x-slot:title>
        {{ $title }}
    </x-slot:title>

    <x-slot:header>
        {{ $header }}
    </x-slot:header>

    <!-- Card Example -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 xl:my-8 xl:mx-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Data Program Studi</h2>
            <p>Kelola informasi prodi di sini.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-2">Tugas</h2>
            <p>Kelola tugas mahasiswa di sini.</p>
        </div>
    </div>
</x-layout-prodi>
