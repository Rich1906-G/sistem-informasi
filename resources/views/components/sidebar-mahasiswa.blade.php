<!-- Sidebar -->
<aside class="w-64 bg-blue-900 text-white min-h-screen p-4 hidden md:block">
    <h2 class="text-xl font-bold mb-6">Dashboard Mahasiswa</h2>
    <nav>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                    🏠 Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.mahasiswa') }}" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                    📘 Data Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.tugas') }}" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                    📝 Tugas
                </a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="block py-2 px-4 rounded hover:bg-red-700 transition">
                    🏃‍♂️ Logout
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Mobile Sidebar (drawer) -->
<div x-data="{ open: false }" class="md:hidden">
    <!-- Button -->
    <button @click="open = !open" class="p-4 bg-blue-900 text-white w-full flex justify-between">
        <span>Menu</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
            class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <!-- Drawer -->
    <div x-show="open" class="absolute bg-blue-900 text-white w-2/3 h-screen p-4">
        <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
        <nav>
            <ul class="space-y-4">
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                        📘 Data Mahasiswa
                    </a>
                </li>
                <li>
                    <a href="#" class="block py-2 px-4 rounded hover:bg-blue-700 transition">
                        📝 Tugas
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
