<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-title>{{ $title }}</x-title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex">

    <x-sidebar></x-sidebar>

    <!-- Content -->
    <main class="flex-1">
        <x-header>{{ $header }}</x-header>
        {{ $slot }}
    </main>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>
</body>

</html>
