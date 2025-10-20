<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="icon" href="{{ asset('images/logo_rsgm.png') }}">
    <title>Login — Logbook Dokter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen antialiased">
    <div class="relative min-h-screen">
        {{-- BG: full-bleed, fokus bisa diatur. Kalau masih terasa zoom, turunin ke center_25% --}}
        <div class="absolute inset-0 -z-10 bg-cover bg-center md:bg-[position:center_35%]"
            style="background-image:url('{{ asset('images/rsgm_new.jpg') }}')"></div>
        {{-- Overlay untuk kontras --}}
        <div class="absolute inset-0 -z-10 bg-gradient-to-b from-black/55 via-black/35 to-black/55"></div>

        {{-- Container tengah --}}
        <div class="min-h-screen flex items-center justify-center px-4">
            <div class="w-full max-w-md">
                {{-- Header kecil --}}
                <div class="flex items-center gap-3 mb-5 text-white drop-shadow">
                    @if (file_exists(public_path('images/logo_rsgm.png')))
                        <img src="{{ asset('images/logo_rsgm.png') }}" alt="Logo" class="h-28 w-28">
                    @endif
                    <div>
                        <p class="text-md uppercase tracking-wider opacity-80">Sistem Logbook</p>
                        <h1 class="text-4xl font-bold leading-tight">Dokter</h1>
                    </div>
                </div>

                {{-- Kartu login --}}
                <div
                    class="rounded-2xl bg-white/90 backdrop-blur-sm border border-white/40 shadow-xl ring-1 ring-black/5 p-5">
                    <h2 class="text-xl font-semibold">Masuk Akun</h2>
                    <p class="text-sm text-gray-600">Gunakan kredensial yang diberikan kampus.</p>
                    <hr class="my-3" />

                    <form class="grid gap-4" action="{{ route('login.dokter.submit') }}" method="post" novalidate>
                        @csrf

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="username">Username</label>
                            <input id="username" name="username" type="text" inputmode="text"
                                autocomplete="username" required
                                class="w-full rounded-lg border border-gray-300 bg-white text-gray-900 text-sm p-2.5
                            focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Username" value="{{ old('username') }}" />
                            @error('username')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                            </div>

                            <div class="relative">
                                <input id="password" name="password" type="password" autocomplete="current-password"
                                    required
                                    class="w-full pr-10 rounded-lg border border-gray-300 bg-white text-gray-900 text-sm p-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="********" />

                                <!-- Tombol mata -->
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 cursor-pointer"
                                    aria-label="Tampilkan/sembunyikan password" aria-pressed="false"
                                    data-toggle-password data-target="password" title="Lihat/Sembunyikan">
                                    <!-- eye (show) -->
                                    <svg data-eye class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <!-- eye-off (hide) -->
                                    <svg data-eye-off class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <path
                                            d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a21.77 21.77 0 0 1 5.06-5.94" />
                                        <path d="M1 1l22 22" />
                                        <path d="M9.88 9.88A3 3 0 0 0 12 15a3 3 0 0 0 2.12-.88" />
                                    </svg>
                                </button>
                            </div>

                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="flex items-center justify-between">
                            <label class="inline-flex items-center gap-2 text-sm text-gray-700 select-none">
                                <input type="checkbox" name="remember"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                Ingat saya
                            </label>
                        </div>

                        <button type="submit"
                            class="mt-1 inline-flex items-center justify-center gap-2 w-full px-5 py-2.5 rounded-lg text-sm font-medium text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300">
                            Masuk
                        </button>
                    </form>
                </div>

                {{-- Footer kecil --}}
                <p class="mt-3 text-xs text-center text-white/70">© {{ date('Y') }} — Sistem Logbook Dokter.</p>
            </div>
        </div>
    </div>
</body>

</html>
