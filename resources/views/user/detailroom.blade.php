<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kost Putri Adi Laksmi - Room Booking</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2a9d8f;
            --secondary-color: #264653;
            --accent-color: #e9c46a;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --success-color: #4caf50;
            --danger-color: #e63946;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary-color);
            letter-spacing: 0.5px;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0.75rem 0;
            font-size: 0.9rem;
        }

        .breadcrumb-item a {
            color: #6c757d;
            text-decoration: none;
            transition: color 0.3s;
        }

        .breadcrumb-item a:hover {
            color: var(--primary-color);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        .room-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
            background-color: white;
            border: none;
        }

        .room-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .room-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
            position: relative;
            display: inline-block;
        }

        .room-number::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--accent-color);
            border-radius: 3px;
        }

        .room-price {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .room-price small {
            font-size: 1rem;
            font-weight: 400;
            color: #6c757d;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .available {
            background-color: rgba(76, 175, 80, 0.15);
            color: var(--success-color);
        }

        .unavailable {
            background-color: rgba(230, 57, 70, 0.15);
            color: var(--danger-color);
        }

        .facility-item {
            margin-bottom: 10px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .facility-item i {
            width: 24px;
            text-align: center;
            margin-right: 10px;
            color: var(--primary-color);
        }

        .btn-book {
            background-color: var(--primary-color);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(42, 157, 143, 0.3);
            text-transform: uppercase;
            font-size: 0.9rem;
        }

        .btn-book:hover {
            background-color: var(--secondary-color);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(38, 70, 83, 0.4);
        }

        .btn-outline-secondary {
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 500;
            border-width: 2px;
            transition: all 0.3s;
        }

        .btn-outline-secondary:hover {
            background-color: var(--secondary-color);
            color: white;
            border-color: var(--secondary-color);
        }

        .section-title {
            position: relative;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: var(--secondary-color);
            font-size: 1.3rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -8px;
            width: 50px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 4px;
        }

        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .room-image {
            height: 350px;
            object-fit: cover;
            width: 100%;
            border-radius: 16px 16px 0 0;
        }

        .room-details {
            padding: 25px;
        }

        .occupant-btn {
            border-radius: 8px !important;
            padding: 8px 20px;
            font-weight: 500;
        }

        .rating {
            color: var(--accent-color);
            font-size: 1rem;
            margin-left: 5px;
        }

        .amenities-section {
            background-color: rgba(233, 196, 106, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-top: 20px;
        }

        .amenities-title {
            color: var(--secondary-color);
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .amenities-title i {
            margin-right: 10px;
            color: var(--primary-color);
        }

        .highlight-box {
            background: linear-gradient(135deg, rgba(42, 157, 143, 0.1), rgba(233, 196, 106, 0.1));
            border-left: 4px solid var(--primary-color);
            padding: 15px;
            border-radius: 0 8px 8px 0;
            margin: 20px 0;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        @media (max-width: 768px) {
            .room-number {
                font-size: 1.6rem;
            }

            .room-price {
                font-size: 1.4rem;
            }

            .action-buttons {
                justify-content: center;
            }

            .btn-book,
            .btn-outline-secondary {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('user.home') }}" class="text-decoration-none"><i
                            class="fas fa-home me-1"></i> Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.listroom') }}" class="text-decoration-none">Daftar
                        Kamar</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Kamar</li>
            </ol>
        </nav>

        <div class="row g-4">
            <!-- Room Image -->
            <div class="col-lg-6">
                <div class="room-card h-100">
                    @if ($room->gambar)
                        <img src="{{ asset('storage/' . $room->gambar) }}" class="room-image" alt="Room Image">
                    @else
                        <img src="https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80"
                            class="room-image" alt="Room Image">
                    @endif
                    <div class="room-details">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h2 class="room-number mb-2">Kamar No. {{ $room->no_kamar }}</h2>

                            </div>
                            <div class="text-end">
                                <h3 class="room-price mb-0">Rp {{ number_format($room->harga, 0, ',', '.') }}</h3>
                                <small class="text-muted">per bulan</small>
                            </div>
                        </div>

                        <div class="highlight-box">
                            <p class="mb-0">{{ $room->deskripsi_kamar }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="col-lg-6">
                <div class="room-card p-4 h-100">
                    <!-- Status -->
                    <div class="mb-4">
                        <h5 class="section-title">Status Kamar</h5>
                        <div class="d-flex align-items-center gap-3">
                            <span class="status-badge {{ $room->status == 'available' ? 'available' : 'unavailable' }}">
                                <i
                                    class="fas {{ $room->status == 'available' ? 'fa-check-circle' : 'fa-times-circle' }} me-2"></i>
                                {{ $room->status == 'available' ? 'Tersedia' : 'Tidak Tersedia' }}
                            </span>
                        </div>
                    </div>

                    <!-- Occupants -->
                    <div class="mb-4">
                        <h5 class="section-title">Jumlah Penghuni</h5>
                        <div class="btn-group" role="group">
                            <input type="radio" class="btn-check" name="occupants" id="occupant1" autocomplete="off"
                                checked>
                            <label class="btn btn-outline-primary occupant-btn" for="occupant1">1 Orang</label>

                        </div>
                    </div>

                    <!-- Facilities -->
                    <div class="amenities-section">
                        <h5 class="amenities-title">
                            <i class="fas fa-list-check"></i> Fasilitas Kamar
                        </h5>
                        <div class="row">
                            <div class="col-md-6">
                                @foreach (explode(',', $room->fasilitas) as $fasilitas)
                                    <div class="facility-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>{{ trim($fasilitas) }}</span>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    <!-- Booking Button -->
                    <div class="action-buttons mt-4">
                        <a href="{{ route('user.listroom') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-door-open me-2"></i>Lihat Kamar Lain
                        </a>

                        <a href="{{ auth()->check() ? route('user.booking', ['room_id' => $room->id]) : '#' }}"
                            class="btn btn-book text-white {{ $room->status != 'available' ? 'disabled cursor-not-allowed opacity-50' : '' }}"
                            @if (!auth()->check()) data-bs-toggle="modal" data-bs-target="#loginModal" @endif>
                            <i class="fas fa-calendar-check me-2"></i> Booking Sekarang
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Login Dulu -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-3 shadow">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Akses Dibatasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    Anda harus login terlebih dahulu untuk melakukan booking kamar ini.
                </div>
                <div class="modal-footer">
                    <a href="{{ route('auth.user.login') }}" class="btn btn-primary">Login</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple animation for page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.room-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 150);
            });

            // Add initial styles for animation
            const style = document.createElement('style');
            style.textContent = `
                .room-card {
                    opacity: 0;
                    transform: translateY(20px);
                    transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.1);
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>

</html>
