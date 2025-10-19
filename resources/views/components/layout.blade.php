<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{ asset('images/logo_rsgm.png') }}">
    <x-title>{{ $title }}</x-title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen md:grid md:grid-cols-[16rem_1fr]">
    {{-- Sidebar tampil hanya di desktop --}}
    <x-sidebar />

    {{-- Konten --}}
    <main class="min-h-screen">
        <x-header>{{ $header }}</x-header>

        <div class="p-4 sm:p-6 md:p-2">
            {{ $slot }}
        </div>
    </main>
</body>

</html>
