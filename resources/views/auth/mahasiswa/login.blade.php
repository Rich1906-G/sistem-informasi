<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div class="w-full">
        <div class="bg-gray-700 p-4">
            <label class="text-gray-300 font-normal text-xl">SIAM</label>
        </div>

        <div class="grid grid-cols-[1fr_10fr]">
            {{-- 10 Berita Terbaru --}}
            <div class="w-96 bg-slate-200 rounded-md grid items-center justify-start my-5 mx-5 py-4 px-8">
                <div class="flex flex-col gap-4">
                    <label class="text-gray-700 text-md font-light pl-2">10 Berita Terbaru</label>
                    <div class="grid gap-4 ">
                        <a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a>
                        <a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a><a href="#"
                            class="list-disc list-inside text-md space-y-1 text-blue-600 w-auto hover:bg-gray-300 hover:rounded-md p-2">
                            <span>
                                Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1 Contoh Berita 1
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-4 my-5 pt-5 w-auto px-5">
                <label class="text-3xl font-bold">SISTEM INFORMASI AKADEMIK MAHASISWA</label>

                <div class="grid bg-gray-100 p-4 rounded-md">
                    <label class="font-light text-2xl">LOGIN MAHASISWA</label>
                    <hr class="my-2">

                    <form class="grid my-4 max-w-xl" action="{{ route('login.mahasiswa.submit') }}" method="post">
                        @csrf
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input type="text" name="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Username" required />
                        </div>
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required placeholder="********" />
                        </div>
                        <div>
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                        </div>
                    </form>

                </div>

                <div class="">
                    <label class="">Catatan: </label>
                    <ul class="list-disc list-inside space-y-2 mt-4">
                        <li>Setiap mahasiswa/i bisa login ke dalam sistem dengan menggunakan "Nomor Induk Mahasiswa" dan
                            "Kata Kunci" masing - masing.
                        </li>
                        <li>Untuk mahasiswa/i yang belum pernah login sama sekali, bisa login langsung dengan
                            menggunakan kata kunci yang sama dengan nomor induk mahasiswa.
                        </li>
                        <li>Setiap mahasiswa/i yang telah berhasil login ke dalam sistem, dianjurkan untuk memperbaharui
                            kata kunci masing - masing untuk menjaga kerahasiaan data setiap mahasiswa/i.
                        </li>
                        <li>Apabila ada masalah, silakan hubungi Biro Administrasi Umum Universitas Prima Indonesia atau
                            email langsung ke <a href="mailto:contact@unprimdn.ac.id"
                                class="text-blue-600 underline">contact@unprimdn.ac.id</a> dengan menyertakan identitas
                            NIM dan nama Mahasiswa/i yang bersangkutan, serta gunakanlah bahasa Indonesia yang baik,
                            benar, dan sopan.
                        </li>
                    </ul>
                </div>
            </div>
        </div>


    </div>
</body>

</html>
