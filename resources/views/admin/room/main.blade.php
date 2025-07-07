@extends('admin.layouts.app')

@section('title', 'Kelola Kamar')

@section('content')
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <!-- Page Title and Controls -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 w-full">


            <!-- Filter and Search Section -->
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full sm:w-auto">
                <!-- Availability Filter -->
                <form method="GET" action="{{ route('kamar') }}" class="mb-4 pt-4">
                    <div class="relative w-full sm:w-48">
                        <select name="availability" onchange="this.form.submit()"
                            class="w-full appearance-none bg-white border border-gray-300 rounded-full px-4 py-2 pr-8 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                            <option value="">Semua Status</option>
                            <option value="available" {{ request('availability') == 'available' ? 'selected' : '' }}>
                                Tersedia</option>
                            <option value="booked" {{ request('availability') == 'booked' ? 'selected' : '' }}>Dipesan
                            </option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </form>

                <!-- Search Form -->
                <div class="w-full sm:w-64">
                    <form action="" method="GET" class="relative">
                        <div class="flex shadow-sm">
                            <input type="text" name="search" placeholder="Cari kamar..." value="{{ request('search') }}"
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
            </div>
        </div>

        <!-- Header Actions -->
        <div class="w-full sm:w-auto flex justify-end">
            @include('admin.layouts.header')
        </div>
    </div>

    {{-- Modal Tambah Kamar --}}
    @include('admin.room.createroom')

    {{-- Room Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-auto max-h-[70vh]">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="sticky top-0 bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No Kamar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fasilitas
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($kamar as $item)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $item->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $item->no_kamar }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                <div class="line-clamp-2">{{ $item->deskripsi_kamar }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs">
                                <div class="line-clamp-2">{{ $item->fasilitas }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->gambar)
                                    <img src="{{ asset('storage/' . $item->gambar) }}" alt="Gambar Kamar"
                                        class="w-16 h-16 object-cover rounded-md border border-gray-200 shadow-sm">
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($item->status == 'available')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Available
                                    </span>
                                @elseif($item->status == 'booked')
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Booked
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    @include('admin.room.updateroom')
                                    @include('admin.room.deleteroom')
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($kamar->hasPages())
            <div class="bg-gray-50 px-6 py-3 border-t border-gray-100">
                {{ $kamar->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        table {
            min-width: 1000px;
        }

        @media (max-width: 640px) {
            table {
                min-width: 1200px;
            }
        }
    </style>

    <script>
        function openCreateModal() {
            // Implement your modal opening logic here
            // Example: document.getElementById('create-room-modal').classList.remove('hidden');
        }
    </script>
@endsection
