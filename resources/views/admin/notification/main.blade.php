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
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Email
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Tipe
                            Pembayaran</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            Tanggal Sewa</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Jatuh
                            Tempo</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Total
                            Tagihan</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($notifikasi as $index => $item)
                        <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">{{ $index + $notifikasi->firstItem() }}</td>
                            <td class="px-6 py-4">{{ $item->penghuni->nama_lengkap ?? ($item->penghuni->name ?? '-') }}</td>
                            <td class="px-6 py-4">{{ $item->kamar->no_kamar ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->penghuni->email ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->tipe_pembayaran ?? '-' }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->tanggal_sewa)->format('d-m-Y') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $tanggalSewa = \Carbon\Carbon::parse($item->tanggal_sewa);
                                    $tipe = strtolower(trim($item->tipe_pembayaran));

                                    if ($tipe === 'Bulanan') {
                                        $jatuhTempo = $tanggalSewa->copy()->addDays(30);
                                    } elseif ($tipe === 'Mingguan') {
                                        $jatuhTempo = $tanggalSewa->copy()->addDays(7);
                                    } else {
                                        $jatuhTempo = $tanggalSewa;
                                    }
                                @endphp
                                {{ $jatuhTempo->format('d-m-Y') }}
                            </td>
                            <td class="px-6 py-4">{{ $item->total_pembayaran ?? '-' }}</td>
                            <td class="px-6 py-4 space-x-2">
                                @include('admin.notification.email')
                            </td>


                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada notifikasi.</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $notifikasi->links() }}
            </div>
        </div>
    </div>

@endsection
