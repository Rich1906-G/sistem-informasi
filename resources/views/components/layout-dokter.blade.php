<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-title-prodi>{{ $title }}</x-title-prodi>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <x-sidebar-dokter></x-sidebar-dokter>

    <!-- Content -->
    <main class="flex-1">
        <x-header-prodi>{{ $header }}</x-header-prodi>
        {{ $slot }}
    </main>

</body>

</html>
