<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-title-mahasiswa>{{ $title }}</x-title-mahasiswa>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <x-sidebar-mahasiswa></x-sidebar-mahasiswa>


    <!-- Content -->
    <main class="flex-1">
        <x-header-mahasiswa>{{ $header }}</x-header-mahasiswa>
        {{ $slot }}
    </main>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
