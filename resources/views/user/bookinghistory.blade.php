<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Booking Kamar Kos</title>
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
            background-color: #17a2b8;
            color: white;
        }

        .badge-cancelled {
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
                <p class="text-muted">Riwayat pemesanan kamar kos Anda</p>
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
                <span class="badge bg-primary-light">Total: 3 Booking</span>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No. Booking</th>
                                <th>Kamar</th>
                                <th>Periode</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Booking 1 -->
                            <tr>
                                <td>#BK-2023-001</td>
                                <td>
                                    <strong>Kamar Hijau 01</strong><br>
                                    <small class="text-muted">Type: AC + Kamar Mandi Dalam</small>
                                </td>
                                <td>
                                    15 Jul - 15 Aug 2023<br>
                                    <small class="text-muted">(30 hari)</small>
                                </td>
                                <td>Rp 1.800.000</td>
                                <td>
                                    <span class="badge badge-confirmed">
                                        <i class="fas fa-check-circle me-1"></i>Confirmed
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#bookingDetailModal">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Booking 2 -->
                            <tr>
                                <td>#BK-2023-002</td>
                                <td>
                                    <strong>Kamar Hijau 02</strong><br>
                                    <small class="text-muted">Type: AC + Kamar Mandi Luar</small>
                                </td>
                                <td>
                                    1 Aug - 1 Sep 2023<br>
                                    <small class="text-muted">(31 hari)</small>
                                </td>
                                <td>Rp 1.550.000</td>
                                <td>
                                    <span class="badge badge-pending">
                                        <i class="fas fa-clock me-1"></i>Pending
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#bookingDetailModal">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>

                            <!-- Booking 3 -->
                            <tr>
                                <td>#BK-2023-003</td>
                                <td>
                                    <strong>Kamar Hijau 03</strong><br>
                                    <small class="text-muted">Type: Non-AC + Kamar Mandi Dalam</small>
                                </td>
                                <td>
                                    10 Jun - 10 Jul 2023<br>
                                    <small class="text-muted">(30 hari)</small>
                                </td>
                                <td>Rp 1.200.000</td>
                                <td>
                                    <span class="badge badge-completed">
                                        <i class="fas fa-calendar-check me-1"></i>Completed
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#bookingDetailModal">
                                        <i class="fas fa-eye"></i> Detail
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer bg-transparent">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mb-0">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Booking Detail Modal -->
    <div class="modal fade" id="bookingDetailModal" tabindex="-1" aria-labelledby="bookingDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookingDetailModalLabel">
                        <i class="fas fa-file-invoice me-2"></i>Detail Booking #BK-2023-001
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">
                                        <i class="fas fa-home me-2"></i>Informasi Kamar
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Nama Kamar:</span>
                                            <strong>Kamar Hijau 01</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Tipe Kamar:</span>
                                            <strong>AC + Kamar Mandi Dalam</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Lantai:</span>
                                            <strong>2</strong>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="mb-2">Fasilitas:</div>
                                            <div class="d-flex flex-wrap gap-2">
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-bed me-1"></i>Kasur
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-archive me-1"></i>Lemari
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-wifi me-1"></i>WiFi
                                                </span>
                                                <span class="badge bg-light text-dark">
                                                    <i class="fas fa-tv me-1"></i>TV
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card shadow-sm mb-4">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">
                                        <i class="fas fa-calendar-alt me-2"></i>Detail Pemesanan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Tanggal Booking:</span>
                                            <strong>10 Jul 2023</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Check In:</span>
                                            <strong>15 Jul 2023</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Check Out:</span>
                                            <strong>15 Aug 2023</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Durasi:</span>
                                            <strong>30 hari</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Harga per Bulan:</span>
                                            <strong>Rp 1.800.000</strong>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Status:</span>
                                            <span class="badge badge-confirmed">
                                                <i class="fas fa-check-circle me-1"></i>Confirmed
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow-sm">
                                <div class="card-header bg-transparent">
                                    <h6 class="mb-0">
                                        <i class="fas fa-sticky-note me-2"></i>Catatan Tambahan
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-request mb-0">
                                        <p class="mb-0">Mohon disediakan tambahan bantal dan selimut. Saya akan tiba
                                            sekitar jam 2 siang di tanggal check-in.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Tutup
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="fas fa-times-circle me-1"></i> Batalkan Booking
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="fas fa-print me-1"></i> Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
