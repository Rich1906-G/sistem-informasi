{{-- ===================== SIDEBAR MAHASISWA (DESKTOP) ===================== --}}
<aside
    class="hidden md:flex md:flex-col md:sticky md:top-0 md:h-screen md:w-[245px]
         bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900
         text-white p-4 gap-4 ring-1 ring-white/10 shadow-xl">

    {{-- Brand --}}
    <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 px-2 pt-2">
        <img src="{{ asset('images/logo_rsgm.png') }}" alt="Logo"
            class="h-10 w-10 rounded-xl ring-1 ring-white/20 bg-white/5 object-contain" />
        <div>
            <h2 class="text-lg font-semibold leading-tight">Dashboard Mahasiswa</h2>
        </div>
    </a>

    {{-- Nav --}}
    <nav class="mt-3">
        <ul class="space-y-2">


            {{-- Profile Mahasiswa --}}
            <li>
                <a href="{{ route('mahasiswa.mahasiswa') }}"
                    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
                  {{ request()->routeIs('mahasiswa.mahasiswa')
                      ? 'bg-white/15 text-white ring-1 ring-white/20 shadow'
                      : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <svg class="h-5 w-5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="8" r="4" />
                        <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
                    </svg>
                    <span>Profile Mahasiswa</span>
                </a>
            </li>

            {{-- Tugas --}}
            <li>
                <a href="{{ route('mahasiswa.tugas') }}"
                    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
                  {{ request()->routeIs('mahasiswa.tugas')
                      ? 'bg-white/15 text-white ring-1 ring-white/20 shadow'
                      : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <svg class="h-5 w-5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="16" rx="2" />
                        <path d="M8 8h8M8 12h6M8 16h4" />
                    </svg>
                    <span>Tugas</span>
                </a>
            </li>
        </ul>
    </nav>

    {{-- Footer + Logout --}}
    <div class="mt-auto">
        <a href="{{ route('logout.mahasiswa') }}" data-logout-get
            class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
              bg-red-500/15 text-red-100 hover:bg-red-500/25 ring-1 ring-red-200/30">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 17l5-5-5-5" />
                <path d="M15 12H3" />
                <path d="M21 21V3" />
            </svg>
            <span>Logout</span>
        </a>
        <p class="mt-3 text-center text-xs text-white/60">© {{ date('Y') }} Logbook • v1.0</p>
    </div>
</aside>

{{-- ===================== TOPBAR + DRAWER (MOBILE) ===================== --}}
<div x-data="{ open: false }" x-effect="document.body.classList.toggle('overflow-hidden', open)" class="md:hidden">
    {{-- Topbar --}}
    <header class="sticky top-0 z-30 bg-white/85 backdrop-blur border-b border-slate-200">
        <div class="flex items-center justify-between px-4 py-3">
            <button @click="open = true"
                class="inline-flex items-center gap-2 rounded-lg px-3 py-2 border border-slate-300 bg-white text-slate-700 shadow-sm active:scale-[.99] cursor-pointer">
                <svg class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo_rsgm.png') }}" alt="Logo"
                    class="h-8 w-8 rounded-md ring-1 ring-slate-200 object-contain">
                <span class="font-semibold text-slate-800">Dashboard Mahasiswa</span>
            </a>
        </div>
    </header>

    {{-- Overlay + Panel --}}
    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-40">
        <div class="absolute inset-0 bg-black/40" @click="open=false" aria-hidden="true"></div>

        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-full opacity-0" @keydown.escape.window="open=false"
            class="absolute left-0 top-0 h-full w-[88vw] max-w-xs p-4
                bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900
                text-white ring-1 ring-white/10 shadow-2xl
                flex flex-col ">

            {{-- Header kecil --}}
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo_rsgm.png') }}"
                        class="h-8 w-8 rounded-md ring-1 ring-white/20 object-contain" alt="Logo" />
                    <span class="font-semibold">Dashboard Mahasiswa</span>
                </div>
                <button @click="open=false"
                    class="p-2 rounded-lg bg-white/10 hover:bg-white/20 ring-1 ring-white/20 cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            {{-- NAV (scrollable) --}}
            <nav class="flex-1 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('mahasiswa.mahasiswa') }}"
                            class="block px-3 py-2 rounded-lg
                      {{ request()->routeIs('mahasiswa.mahasiswa') ? 'bg-white/15 ring-1 ring-white/20 shadow' : 'hover:bg-white/10' }}">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 opacity-90" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 4-6 8-6s8 2 8 6" />
                                </svg>
                                <span>Profile Mahasiswa</span>
                            </div>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('mahasiswa.tugas') }}"
                            class="block px-3 py-2 rounded-lg
                      {{ request()->routeIs('mahasiswa.tugas') ? 'bg-white/15 ring-1 ring-white/20 shadow' : 'hover:bg-white/10' }}">
                            <div class="flex items-center gap-2">
                                <svg class="h-5 w-5 opacity-90" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="16" rx="2" />
                                    <path d="M8 8h8M8 12h6M8 16h4" />
                                </svg>
                                <span>Tugas</span>
                            </div>
                        </a>
                    </li>

                </ul>
            </nav>

            {{-- FOOTER (Logout tetap di bawah) --}}
            <div class="pt-3 border-t border-white/10">
                <a href="{{ route('logout.mahasiswa') }}" data-logout-get
                    class="block px-3 py-2 rounded-lg bg-red-500/15 hover:bg-red-500/25 ring-1 ring-red-200/30">
                    <div class="flex items-center gap-2">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M10 17l5-5-5-5" />
                            <path d="M15 12H3" />
                            <path d="M21 21V3" />
                        </svg>
                        <span>Logout</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
