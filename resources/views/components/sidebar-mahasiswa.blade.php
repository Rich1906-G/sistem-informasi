<!-- Sidebar -->
<aside class="w-64 bg-blue-900 text-white min-h-screen p-4 hidden md:block">
    <h2 class="text-xl font-bold mb-6">Dashboard Mahasiswa</h2>
    <nav>
        <ul class="space-y-4">
            <li>
                <a href="{{ route('mahasiswa.dashboard') }}"
                    class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M240-200h120v-240h240v240h120v-360L480-740 240-560v360Zm-80 80v-480l320-240 320 240v480H520v-240h-80v240H160Zm320-350Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.mahasiswa') }}"
                    class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M234-276q51-39 114-61.5T480-360q69 0 132 22.5T726-276q35-41 54.5-93T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 59 19.5 111t54.5 93Zm246-164q-59 0-99.5-40.5T340-580q0-59 40.5-99.5T480-720q59 0 99.5 40.5T620-580q0 59-40.5 99.5T480-440Zm0 360q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q53 0 100-15.5t86-44.5q-39-29-86-44.5T480-280q-53 0-100 15.5T294-220q39 29 86 44.5T480-160Zm0-360q26 0 43-17t17-43q0-26-17-43t-43-17q-26 0-43 17t-17 43q0 26 17 43t43 17Zm0-60Zm0 360Z" />
                    </svg> Profile Mahasiswa
                </a>
            </li>
            <li>
                <a href="{{ route('mahasiswa.tugas') }}"
                    class="flex items-center gap-2 py-2 px-4 rounded hover:bg-blue-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z" />
                    </svg>
                    Tugas
                </a>
            </li>
            <li>
                <a href="{{ route('logout.mahasiswa') }}" data-logout-get
                    class="flex items-center gap-2 py-2 px-4 rounded hover:bg-red-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#FFFFFF">
                        <path
                            d="M200-120q-33 0-56.5-23.5T120-200v-160h80v160h560v-560H200v160h-80v-160q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm220-160-56-58 102-102H120v-80h346L364-622l56-58 200 200-200 200Z" />
                    </svg>
                    Logout
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
