<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-title-prodi>{{ $title }}</x-title-prodi>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex">

    <x-sidebar-prodi></x-sidebar-prodi>



    <!-- Content -->
    <main class="flex-1">
        <x-header-prodi>{{ $header }}</x-header-prodi>
        {{ $slot }}
    </main>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
