<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-title-dokter>{{ $title }}</x-title-dokter>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex">

    <x-sidebar-dokter></x-sidebar-dokter>

    <!-- Content -->
    <main class="flex-1">
        <x-header-dokter>{{ $header }}</x-header-dokter>
        {{ $slot }}
    </main>

</body>

</html>
