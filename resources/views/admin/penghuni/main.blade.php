@extends('admin.layouts.app')

@section('title', 'Kelola Pengguna')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
        <!-- Search Form (Left) -->
        <div class="w-full sm:w-64">
            <form action="{{ route('penghuni') }}" method="GET" class="relative">
                <div class="flex shadow-sm">
                    <input type="text" name="search" placeholder="Cari penghuni..." value="{{ request('search') }}"
                        class="w-full px-4 py-2 text-sm rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full ml-2 transition duration-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="sr-only">Cari</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Header (Right) -->
        <div class="w-full sm:w-auto flex justify-end">
            @include('admin.layouts.header')
        </div>
    </div>
    {{-- Modal Tambah Kamar --}}
    @include('admin.penghuni.create')

    {{-- Tabel Data Kamar --}}
    <div class="bg-white rounded-lg shadow-md p-6 mt-5">
        <div class="overflow-x-auto">
            <table class="w-full bg-white rounded-lg overflow-hidden">
                <thead class="sticky top-0 bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Lengkap</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No Hp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Tanggal Lahir</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($penghuni as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->no_hp }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $user->tanggal_lahir }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                <div class="line-clamp-1">{{ $user->alamat }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @include('admin.penghuni.edit-penghuni')
                                    @include('admin.penghuni.hapus-penghuni')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @stack('scripts')

    {{-- Pagination --}}
    {{-- <div class="mt-4">
        {{ $kamar->links('vendor.pagination.tailwind') }}
    </div> --}}
@endsection
