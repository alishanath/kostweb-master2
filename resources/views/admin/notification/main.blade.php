@extends('admin.layouts.app')

@section('title', 'Kelola Notifikasi')

@section('content')

    <div class="bg-white p-6 rounded-xl shadow-lg mt-10">
        <div class="overflow-auto max-h-[70vh] rounded-lg">
            <table class="min-w-full table-auto border-collapse text-sm text-gray-700">
                <thead class="sticky top-0 z-10 bg-gradient-to-r from-gray-100 to-gray-200 shadow-sm">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">No
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Nama
                            Penghuni</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">No
                            Kamar</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            Email</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            Tanggal Sewa</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Jatuh
                            Tempo
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4">1</td>
                        <td class="px-6 py-4">John Doe</td>
                        <td class="px-6 py-4">Kamar 12</td>
                        <td class="px-6 py-4">2025-05-01</td>
                        <td class="px-6 py-4">
                            <a href="#" class="text-blue-600 hover:underline">Lihat Bukti</a>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">Lunas</span>
                        </td>
                        <td class="px-6 py-4 space-x-2">
                            {{-- @include('admin.penghuni.edit-penghuni')
                            @include('admin.penghuni.hapus-penghuni') --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



@endsection
