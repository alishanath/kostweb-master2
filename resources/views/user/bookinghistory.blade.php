<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Booking Kamar Kost</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2e7d32;
            --primary-light: #4caf50;
            --primary-dark: #1b5e20;
            --secondary-color: #f5f5f5;
        }

        body {
            background-color: #f8f9fa;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0 !important;
            padding: 15px 20px;
        }

        /* Table Styling */
        .table {
            margin-bottom: 0;
        }

        .table th {
            background-color: var(--secondary-color);
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }

        .table td {
            vertical-align: middle;
        }

        /* Badge Styling */
        .badge {
            font-size: 0.85rem;
            padding: 0.45em 0.65em;
            font-weight: 500;
            border-radius: 4px;
        }

        .badge-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-confirmed {
            background-color: #28a745;
            color: white;
        }

        .badge-completed {
            background-color: #dc3545;
            color: white;
        }


        /* Button Styling */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .btn-outline-primary {
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
        }

        /* Modal Styling */
        .modal-header {
            background-color: var(--primary-color);
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .modal-title {
            font-weight: 600;
        }

        /* List Group Styling */
        .list-group-item {
            border-left: none;
            border-right: none;
        }

        .list-group-item:first-child {
            border-top: none;
        }

        /* Alert Styling */
        .alert-request {
            background-color: #e8f5e9;
            border-color: #c8e6c9;
            color: #2e7d32;
        }

        /* Utility Classes */
        .text-primary {
            color: var(--primary-color) !important;
        }

        .bg-primary-light {
            background-color: var(--primary-light);
        }

        .shadow-sm {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05) !important;
        }
    </style>
</head>

<body>

    <!-- Main Content -->
    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h3 class="text-primary">
                    <i class="fas fa-calendar-alt me-2"></i>History Booking
                </h3>
                <p class="text-muted">Riwayat pemesanan kamar kost Anda</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('user.home') }}" class="btn btn-outline-primary">
                    <i class="fas fa-filter me-1"></i> Kembali
                </a>
            </div>
        </div>

        <!-- Booking List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Daftar Booking
                </h5>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>No Kamar</th>
                                <th>Tanggal Sewa</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                                <tr>
                                    <td>{{ $booking->kode_booking }}</td>
                                    <td>
                                        {{ $booking->kamar->no_kamar }}
                                        {{-- <strong>{{ $booking->no_kamar }}</strong><br> --}}
                                        {{-- <small class="text-muted">{{ $booking->no_kamar }}</small> --}}
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($booking->tanggal_sewa)->format('d M Y') }}

                                    </td>
                                    <td>Rp {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'Menunggu' => 'badge-pending',
                                                'Diterima' => 'badge-confirmed',
                                                'Ditolak' => 'badge-completed',
                                            ];
                                        @endphp
                                        <span class="badge {{ $statusClass[$booking->status] ?? 'badge-secondary' }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#bookingDetailModal{{ $booking->id }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Detail Modal -->
    @foreach ($bookings as $booking)
        <div class="modal fade" id="bookingDetailModal{{ $booking->id }}" tabindex="-1"
            aria-labelledby="bookingDetailModalLabel{{ $booking->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="bookingDetailModalLabel{{ $booking->id }}">
                            <i class="fas fa-file-invoice me-2"></i>Detail Booking {{ $booking->kode_booking }}
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Informasi Kamar -->
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent">
                                        <h6><i class="fas fa-home me-2"></i>Informasi Kamar</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Kode Booking:</span>
                                                <strong>{{ $booking->kode_booking }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Nama Penghuni:</span>
                                                <strong>{{ $booking->penghuni->name }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Nomer Kamar:</span>
                                                <strong>{{ $booking->kamar->no_kamar }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Jumlah Penghuni</span>
                                                <strong>{{ $booking->jumlah_penghuni }} Orang</strong>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Detail Pemesanan -->
                            <div class="col-md-6">
                                <div class="card shadow-sm mb-4">
                                    <div class="card-header bg-transparent">
                                        <h6><i class="fas fa-calendar-alt me-2"></i>Detail Pemesanan</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Tanggal Booking:</span>
                                                <strong>{{ $booking->tanggal_sewa->format('d M Y') }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Tipe Pembayaran</span>
                                                <strong>{{ $booking->tipe_pembayaran }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Total Pembayaran:</span>
                                                <strong>Rp
                                                    {{ number_format($booking->total_pembayaran, 0, ',', '.') }}</strong>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between">
                                                <span>Status:</span>
                                                <span
                                                    class="badge {{ $statusClass[$booking->status] ?? 'badge-secondary' }}">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        @if ($booking->catatan)
                            <div class="row">
                                <div class="col-12">
                                    <div class="card shadow-sm">
                                        <div class="card-header bg-transparent">
                                            <h6><i class="fas fa-sticky-note me-2"></i>Catatan Tambahan</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="alert alert-request mb-0">
                                                <p class="mb-0">{{ $booking->catatan }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
