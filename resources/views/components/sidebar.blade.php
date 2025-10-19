{{-- ========== DESKTOP SIDEBAR ========== --}}
<aside
    class="hidden md:flex md:flex-col md:w-64 md:sticky md:top-0 md:h-screen
         bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900
         text-white p-4 gap-4 ring-1 ring-white/10 shadow-xl">

    {{-- Brand --}}
    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-2 pt-2">
        <img src="{{ asset('images/logo_rsgm.png') }}" alt="Logo"
            class="h-10 w-10 rounded-xl ring-1 ring-white/20 bg-white/5 object-contain" />
        <div>
            <h2 class="text-lg font-semibold leading-tight">Dashboard Admin</h2>
        </div>
    </a>

    {{-- Nav --}}
    <nav class="mt-2">
        <ul class="space-y-2">
            {{-- Data Mahasiswa --}}
            <li>
                <a href="{{ route('admin.mahasiswa') }}"
                    aria-current="{{ request()->routeIs('admin.mahasiswa') ? 'page' : 'false' }}"
                    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
                  {{ request()->routeIs('admin.mahasiswa')
                      ? 'bg-white/15 text-white ring-1 ring-white/20 shadow'
                      : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <svg class="h-5 w-5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <circle cx="8" cy="8" r="3" />
                        <circle cx="16" cy="8" r="3" />
                        <path d="M3 20c0-3 4-5 5-5m8 0c1 0 5 2 5 5" />
                    </svg>
                    <span>Data Mahasiswa</span>
                </a>
            </li>

            {{-- Data Tugas --}}
            {{-- <li>
                <a href="{{ route('admin.data.tugas') }}"
                    aria-current="{{ request()->routeIs('admin.data.tugas') ? 'page' : 'false' }}"
                    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
                  {{ request()->routeIs('admin.data.tugas')
                      ? 'bg-white/15 text-white ring-1 ring-white/20 shadow'
                      : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <svg class="h-5 w-5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="14" rx="2" />
                        <path d="M7 8h10M7 12h6" />
                    </svg>
                    <span>Data Tugas</span>
                </a>
            </li> --}}

            {{-- Tugas Mahasiswa --}}
            <li>
                <a href="{{ route('admin.tugas.mahasiswa') }}"
                    aria-current="{{ request()->routeIs('admin.tugas.mahasiswa') ? 'page' : 'false' }}"
                    class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
                  {{ request()->routeIs('admin.tugas.mahasiswa')
                      ? 'bg-white/15 text-white ring-1 ring-white/20 shadow'
                      : 'text-white/80 hover:text-white hover:bg-white/10' }}">
                    <svg class="h-5 w-5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2">
                        <path d="M4 6h16M4 12h10M4 18h7" />
                    </svg>
                    <span>Tugas Mahasiswa</span>
                </a>
            </li>
        </ul>
    </nav>

    {{-- Footer + Logout (nempel bawah) --}}
    <div class="mt-auto">
        <a href="{{ route('logout.admin') }}" data-logout-get data-url="{{ route('logout.admin') }}"
            class="group flex items-center gap-3 px-3 py-2 rounded-xl transition-all
              bg-red-500/15 text-red-100 hover:bg-red-500/25 ring-1 ring-red-200/30">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M10 17l5-5-5-5" />
                <path d="M15 12H3" />
                <path d="M21 21V3" />
            </svg>
            <span>Logout</span>
        </a>
        <p class="mt-3 text-center text-xs text-white/60">© {{ date('Y') }} Admin • v1.0</p>
    </div>
</aside>

{{-- ========== TOPBAR + DRAWER MOBILE ========== --}}
<div x-data="{ open: false }" x-effect="document.body.classList.toggle('overflow-hidden', open)" class="md:hidden">

    {{-- Topbar --}}
    <header class="sticky top-0 z-30 bg-white/90 backdrop-blur border-b border-slate-200">
        <div class="flex items-center justify-between px-4 py-3">
            <button @click="open=true"
                class="inline-flex items-center gap-2 rounded-lg px-3 py-2 border border-slate-300
               bg-white text-slate-700 shadow-sm active:scale-[.99] cursor-pointer">
                <svg class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo_rsgm.png') }}" alt="Logo"
                    class="h-8 w-8 rounded-md ring-1 ring-slate-200 object-contain">
                <span class="font-semibold text-slate-800">Dashboard Admin</span>
            </a>
        </div>
    </header>

    {{-- Overlay + Drawer --}}
    <div x-cloak x-show="open" x-transition.opacity class="fixed inset-0 z-40 overscroll-contain">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/40" @click="open=false" aria-hidden="true"></div>

        {{-- Panel --}}
        <div x-show="open" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full opacity-0" x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="-translate-x-full opacity-0" @keydown.escape.window="open=false"
            class="absolute left-0 top-0 h-full w-[92vw] max-w-sm p-4
                bg-gradient-to-b from-blue-900 via-indigo-900 to-blue-900
                text-white ring-1 ring-white/10 shadow-2xl flex flex-col">

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center gap-2 min-w-0">
                    <img src="{{ asset('images/logo_rsgm.png') }}"
                        class="h-8 w-8 rounded-md ring-1 ring-white/20 object-contain" alt="Logo" />
                    <span class="font-semibold truncate">Dashboard Admin</span>
                </div>
                <button @click="open=false"
                    class="p-2 rounded-lg bg-white/10 hover:bg-white/20 ring-1 ring-white/20 cursor-pointer">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2">
                        <path d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span class="sr-only">Tutup</span>
                </button>
            </div>

            {{-- Nav (flex-1 biar logout nempel bawah) --}}
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.mahasiswa') }}"
                            class="group flex items-start gap-3 px-3 py-3 rounded-lg
                      {{ request()->routeIs('admin.mahasiswa') ? 'bg-white/15 ring-1 ring-white/20 shadow' : 'hover:bg-white/10' }}
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/40">
                            <svg class="h-5 w-5 shrink-0 mt-0.5 opacity-90 group-hover:opacity-100" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="8" cy="8" r="3" />
                                <circle cx="16" cy="8" r="3" />
                                <path d="M3 20c0-3 4-5 5-5m8 0c1 0 5 2 5 5" />
                            </svg>
                            <span class="text-base leading-snug whitespace-normal break-words">
                                Data Mahasiswa
                            </span>
                        </a>
                    </li>

                    {{-- <li>
                        <a href="{{ route('admin.data.tugas') }}"
                            class="group flex items-start gap-3 px-3 py-3 rounded-lg
                      {{ request()->routeIs('admin.data.tugas') ? 'bg-white/15 ring-1 ring-white/20 shadow' : 'hover:bg-white/10' }}
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/40">
                            <svg class="h-5 w-5 shrink-0 mt-0.5 opacity-90 group-hover:opacity-100"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="4" width="18" height="14" rx="2" />
                                <path d="M7 8h10M7 12h6" />
                            </svg>
                            <span class="text-base leading-snug whitespace-normal break-words">
                                Data Tugas
                            </span>
                        </a>
                    </li> --}}

                    <li>
                        <a href="{{ route('admin.tugas.mahasiswa') }}"
                            class="group flex items-start gap-3 px-3 py-3 rounded-lg
                      {{ request()->routeIs('admin.tugas.mahasiswa') ? 'bg-white/15 ring-1 ring-white/20 shadow' : 'hover:bg-white/10' }}
                      focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/40">
                            <svg class="h-5 w-5 shrink-0 mt-0.5 opacity-90 group-hover:opacity-100"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M4 6h16M4 12h10M4 18h7" />
                            </svg>
                            <span class="text-base leading-snug whitespace-normal break-words">
                                Tugas Mahasiswa
                            </span>
                        </a>
                    </li>
                </ul>
            </nav>

            {{-- Footer + Logout (di bawah) --}}
            <div class="pt-3 border-t border-white/10">
                <a href="{{ route('logout.admin') }}" data-logout-get data-url="{{ route('logout.admin') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-lg bg-red-500/15 hover:bg-red-500/25 ring-1 ring-red-200/30">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 17l5-5-5-5" />
                        <path d="M15 12H3" />
                        <path d="M21 21V3" />
                    </svg>
                    <span class="text-base leading-snug whitespace-normal break-words">Logout</span>
                </a>
            </div>
        </div>
    </div>
</div>
