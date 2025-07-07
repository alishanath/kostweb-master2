<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Kost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-white">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white h-screen p-5 shadow-md fixed ">
            <h2 class="font-bold text-xl mb-5">🏠 Kost Putri Alifa Purwokerto</h2>
            <ul>
                <li class="mb-2">
                    <a href="{{ route('dashboard') }}"
                        class="block p-2 rounded-full hover:bg-gray-100 hover:text-black {{ request()->routeIs('dashboard') ? 'bg-[#28a745] text-white' : '' }}">📊
                        Dashboard Statistik</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('kamar') }}"
                        class="block p-2 rounded-full hover:bg-gray-100 hover:text-black {{ request()->routeIs('kamar') ? 'bg-[#28a745] text-white' : '' }}">🛏️
                        Kelola Kamar</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('penghuni') }}"
                        class="block p-2 rounded-full hover:bg-gray-100 hover:text-black {{ request()->routeIs('penghuni') ? 'bg-[#28a745] text-white' : '' }}">👥
                        Kelola Pengguna</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('pemesanan') }}"
                        class="block p-2 rounded-full hover:bg-gray-100 hover:text-black {{ request()->routeIs('pemesanan') ? 'bg-[#28a745] text-white' : '' }}">📜
                        Kelola Pemesanan</a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('notifikasi') }}"
                        class="block p-2 rounded-full hover:bg-gray-100 hover:text-black {{ request()->routeIs('notifikasi') ? 'bg-[#28a745] text-white' : '' }}">🔔
                        Kelola Notifikasi</a>
                </li>
            </ul>

            <div class="absolute bottom-5 left-5">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="bg-red-700 text-white px-4 py-2 rounded-full flex items-center gap-x-2">
                        <svg viewBox="0 0 24 24" class="w-5 h-5" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M22 20C22 20.5523 21.5523 21 21 21C20.4477 21 20 20.5523 20 20V4C20 3.44772 20.4477 3 21 3C21.5523 3 22 3.44772 22 4V20Z"
                                    fill="#ffffff" />
                                <path
                                    d="M8.70711 17.7071C9.09763 17.3166 9.09763 16.6834 8.70711 16.2929L5.41421 13L16 13C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11L5.41421 11L8.70711 7.70711C9.09763 7.31658 9.09763 6.68342 8.70711 6.29289C8.31658 5.90237 7.68342 5.90237 7.29289 6.29289L2.29289 11.2929C1.90237 11.6834 1.90237 12.3166 2.29289 12.7071L7.29289 17.7071C7.68342 18.0976 8.31658 18.0976 8.70711 17.7071Z"
                                    fill="#ffffff" />
                            </g>
                        </svg>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>

        </div>

        <!-- Content -->
        <div class="flex-1 ml-[20%] p-10">
            <div class="flex justify-between items-center mb-5">
                <h1 class="text-3xl font-bold mb-8 text-start">@yield('title')</h1>
                <!-- Icon Notifikasi -->
                <div class="relative">
                    <button class="text-gray-600 hover:text-gray-800 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3.001 3.001 0 01-6 0m6 0H9" />
                        </svg>
                    </button>
                    <!-- Notifikasi Badge -->
                    <span class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-800 rounded-full"></span>
                </div>
            </div>

            @yield('content')


        </div>

    </div>

    <div>
    </div>




    @stack('scripts')
</body>

</html>
