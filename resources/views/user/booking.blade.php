<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Kamar - Kost Putri Alfia Purwokerto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        :root {
            --primary-color: #2e7d32;
            --secondary-color: #1b5e20;
            --accent-color: #4caf50;
            --light-bg: #f8f9fa;
            --light-green: #e8f5e9;
            --dark-green: #1b5e20;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .booking-progress {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin-bottom: 2rem;
        }

        .progress-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .step-number {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #e0e0e0;
            color: #757575;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .step-number.active {
            background-color: var(--primary-color);
            color: white;
        }

        .step-label {
            font-size: 0.85rem;
            color: #757575;
            text-align: center;
        }

        .step-label.active {
            color: var(--dark-green);
            font-weight: 500;
        }

        .progress-line {
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: #e0e0e0;
            z-index: 1;
        }

        .progress-line-fill {
            height: 100%;
            background-color: var(--primary-color);
            width: 0%;
            transition: width 0.3s ease;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 1.5rem;
            border-bottom: none;
        }

        .room-image {
            height: 250px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.3s ease;
        }

        .room-image:hover {
            transform: scale(1.02);
        }

        .room-number {
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary {
            border-radius: 8px;
            padding: 10px 25px;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .total-cost {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 0.25rem rgba(76, 175, 80, 0.25);
        }

        .fasilitas-list {
            list-style-type: none;
            padding-left: 0;
        }

        .fasilitas-list li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }

        .fasilitas-list li i {
            margin-right: 0.5rem;
            color: var(--primary-color);
        }

        .modal-footer button {
            min-width: 120px;
        }

        .price-highlight {
            background-color: var(--light-green);
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid var(--primary-color);
        }

        @media (max-width: 768px) {
            .room-number {
                font-size: 2rem;
            }

            .total-cost {
                font-size: 1.5rem;
            }

            .step-label {
                font-size: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <!-- Progress Steps -->
        <div class="booking-progress">
            <div class="progress-line">
                <div class="progress-line-fill" id="progressFill"></div>
            </div>
            <div class="progress-step">
                <div class="step-number active" id="step1">1</div>
                <span class="step-label active">Data Pemesan</span>
            </div>
            <div class="progress-step">
                <div class="step-number" id="step2">2</div>
                <span class="step-label">Konfirmasi</span>
            </div>
            <div class="progress-step">
                <div class="step-number" id="step3">3</div>
                <span class="step-label">Pembayaran</span>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('user.booking.store') }}" id="bookingForm" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <input type="hidden" id="fasilitas" value="{{ strtolower($room->fasilitas) }}">
                    <input type="hidden" name="total_pembayaran" id="total_pembayaran" value="{{ $room->harga }}">

                    <!-- Step 1: Data Pemesan -->
                    <div class="card mb-4" id="step1Content">
                        <div class="card-header text-center">
                            <h1 class="room-number mb-0">Kamar No. {{ $room->no_kamar ?? 'N/A' }}</h1>
                            <p class="mb-0">Kost Putri Alfia Purwokerto</p>
                        </div>

                        <img src="{{ $photoUrl }}" class="room-image" alt="Kamar Kost {{ $room->no_kamar ?? '' }}"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/800x500?text=Image+Not+Found'">

                        <div class="card-body p-4">
                            <h5 class="mb-3" style="color: var(--primary-color);">
                                <i class="fas fa-user-circle me-2"></i> Data Pemesan
                            </h5>
                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="{{ Auth::user()->name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ Auth::user()->email }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="no_hp" class="form-label">No. HP/WhatsApp</label>
                                    <input type="tel" class="form-control" id="no_hp" name="no_hp"
                                        value="{{ Auth::user()->no_hp ?? '' }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" required>{{ Auth::user()->alamat ?? '' }}</textarea>
                                </div>
                            </div>

                            <h5 class="mb-3" style="color: var(--primary-color);">
                                <i class="fas fa-calendar-alt me-2"></i> Detail Penyewaan
                            </h5>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="jumlah_penghuni" class="form-label">Jumlah Penghuni</label>
                                    <select class="form-select" id="jumlah_penghuni" name="jumlah_penghuni" required>
                                        <option value="1" selected>1 Penghuni</option>
                                        <option value="2">2 Penghuni</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="tipe_pembayaran" class="form-label">Tipe Pembayaran</label>
                                    <select class="form-select" id="tipe_pembayaran" name="tipe_pembayaran" required>
                                        <option value="Bulanan" selected>Bulanan</option>
                                        <option value="Mingguan">Mingguan</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="tanggal_sewa" class="form-label">Tanggal Mulai Sewa</label>
                                    <input type="text" class="form-control datepicker" id="tanggal_sewa"
                                        name="tanggal_sewa" required>
                                </div>
                            </div>

                            <div class="price-highlight mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">Total Biaya Sewa:</h5>
                                        <small class="text-muted">(Harga dinamis berdasarkan pilihan)</small>
                                    </div>
                                    <div class="total-cost" id="totalCost">Rp
                                        {{ number_format($room->harga, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between pt-3">
                                <a href="{{ route('user.listroom') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                                <button type="button" class="btn btn-primary" id="nextToStep2">
                                    Lanjut <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Konfirmasi -->
                    <div class="card mb-4 d-none" id="step2Content">
                        <div class="card-header text-center">
                            <h2 class="mb-0">Konfirmasi Data Booking</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="fas fa-user me-2"></i> Data Pemesan
                                    </h5>
                                    <div class="mb-4">
                                        <p><strong>Nama:</strong> <span
                                                id="confirmNama">{{ Auth::user()->name }}</span></p>
                                        <p><strong>Email:</strong> <span
                                                id="confirmEmail">{{ Auth::user()->email }}</span></p>
                                        <p><strong>No. HP:</strong> <span
                                                id="confirmHp">{{ Auth::user()->no_hp ?? '-' }}</span></p>
                                        <p><strong>Alamat:</strong> <span
                                                id="confirmAlamat">{{ Auth::user()->alamat ?? '-' }}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3" style="color: var(--primary-color);">
                                        <i class="fas fa-home me-2"></i> Detail Kamar
                                    </h5>
                                    <div class="mb-4">
                                        <p><strong>No. Kamar:</strong> {{ $room->no_kamar ?? '-' }}</p>
                                        <p><strong>Tipe Pembayaran:</strong> <span
                                                id="confirmTipePembayaran">Bulanan</span></p>
                                        <p><strong>Jumlah Penghuni:</strong> <span id="confirmJmlPenghuni">1</span></p>
                                        <p><strong>Tanggal Mulai:</strong> <span id="confirmTanggalSewa">-</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="price-highlight mb-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-0">Total Pembayaran:</h5>
                                    </div>
                                    <div class="total-cost" id="confirmTotalHarga">Rp
                                        {{ number_format($room->harga, 0, ',', '.') }}</div>
                                </div>
                            </div>

                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle me-2"></i> Pastikan data yang Anda masukkan sudah
                                benar sebelum melanjutkan ke pembayaran.
                            </div>

                            <div class="d-flex justify-content-between pt-3">
                                <button type="button" class="btn btn-outline-secondary" id="backToStep1">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </button>
                                <button type="button" class="btn btn-primary" id="nextToStep3">
                                    Lanjut ke Pembayaran <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Pembayaran -->
                    <div class="card mb-4 d-none" id="step3Content">
                        <div class="card-header text-center">
                            <h2 class="mb-0">Pembayaran</h2>
                        </div>
                        <div class="card-body p-4">
                            <div class="alert alert-info mb-4">
                                <i class="fas fa-info-circle me-2"></i> Harap selesaikan pembayaran dalam <strong>24
                                    jam</strong> untuk menghindari pembatalan otomatis.
                            </div>

                            <h5 class="mb-3" style="color: var(--primary-color);">
                                <i class="fas fa-university me-2"></i> Transfer ke Rekening
                            </h5>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('images/BCA_logo_Bank_Central_Asia.png') }}"
                                                alt="BCA" class="me-3" width="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Bank BCA</h6>
                                                <small class="text-muted">a.n. Alisha Nathania Septianty</small>
                                            </div>
                                        </div>
                                        <div class="bg-light p-2 rounded mb-2">
                                            <small class="text-muted d-block">Nomor Rekening</small>
                                            <strong class="text-primary">0462519298</strong>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary w-100"
                                            onclick="copyToClipboard('0462519298')">
                                            <i class="far fa-copy me-1"></i> Salin
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('images/bri-logo-freelogovectors.net_.png') }}"
                                                alt="BRI" class="me-3" width="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold">Bank BRI</h6>
                                                <small class="text-muted">a.n. Alisha Nathania Septianty</small>
                                            </div>
                                        </div>
                                        <div class="bg-light p-2 rounded mb-2">
                                            <small class="text-muted d-block">Nomor Rekening</small>
                                            <strong class="text-primary">1377 0100 6502 535</strong>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary w-100"
                                            onclick="copyToClipboard('1377 0100 6502 535')">
                                            <i class="far fa-copy me-1"></i> Salin
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="border rounded p-3 h-100">
                                        <div class="d-flex align-items-center mb-3">
                                            <img src="{{ asset('images/qris2.png') }}" alt="Qriss" class="me-3"
                                                width="40">
                                            <div>
                                                <h6 class="mb-0 fw-bold">E-Wallet (DANA, ShopeePay, OVO, GoPay)</h6>
                                                <small class="text-muted">Alisha Nathania Septianty</small>
                                            </div>
                                        </div>
                                        <div class="bg-light p-2 rounded mb-2">
                                            <small class="text-muted d-block">Nomor Hp Penerima</small>
                                            <strong class="text-primary">089685505877</strong>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary w-100"
                                            onclick="copyToClipboard('089685505877')">
                                            <i class="far fa-copy me-1"></i> Salin
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <h5 class="mb-3" style="color: var(--primary-color);">
                                <i class="fas fa-receipt me-2"></i> Upload Bukti Pembayaran
                            </h5>

                            <div class="mb-4">
                                <label for="bukti_pembayaran" class="form-label">File Bukti Transfer (JPG/PNG, maks.
                                    2MB)</label>
                                <input type="file" class="form-control" id="bukti_pembayaran"
                                    name="bukti_pembayaran" accept="image/*" required>
                                <small class="text-muted">Pastikan bukti transfer jelas terbaca</small>
                            </div>

                            <div class="alert alert-warning mb-4">
                                <i class="fas fa-exclamation-triangle me-2"></i> Setelah mengupload bukti pembayaran,
                                admin akan memverifikasi dalam waktu 1x24 jam.
                            </div>

                            <div class="d-flex justify-content-between pt-3">
                                <button type="button" class="btn btn-outline-secondary" id="backToStep2">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </button>
                                <button type="submit" class="btn btn-primary" id="submitBooking">
                                    <i class="fas fa-paper-plane me-2"></i> Kirim Pembayaran
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/id.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize date picker
            flatpickr(".datepicker", {
                locale: "id",
                dateFormat: "Y-m-d", // format data yang disubmit
                altInput: true,
                altFormat: "d F Y", // format yang tampil ke user
                minDate: "today",
                defaultDate: "today"
            });

            // Dynamic pricing calculation
            const fasilitas = document.getElementById('fasilitas').value.toLowerCase();
            const jumlahPenghuni = document.getElementById('jumlah_penghuni');
            const paymentType = document.getElementById('tipe_pembayaran');
            const totalCostElement = document.getElementById('totalCost');
            const hiddenTotalInput = document.getElementById('total_pembayaran');
            const hargaDatabase = {{ $room->harga }};

            function hitungHarga() {
                const jmlPenghuni = parseInt(jumlahPenghuni.value);
                const tipePembayaran = paymentType.value;
                let harga = 0;

                if (fasilitas.includes('kamar mandi dalam')) {
                    if (tipePembayaran === 'Bulanan') {
                        harga = hargaDatabase + (jmlPenghuni === 2 ? 100000 : 0);
                    } else if (tipePembayaran === 'Mingguan') {
                        harga = (jmlPenghuni === 1) ? 175000 : 175000 + 100000;
                    }
                } else if (fasilitas.includes('kamar mandi luar')) {
                    if (tipePembayaran === 'Bulanan') {
                        harga = hargaDatabase + (jmlPenghuni === 2 ? 100000 : 0);
                    } else if (tipePembayaran === 'Mingguan') {
                        harga = (jmlPenghuni === 1) ? 150000 : 150000 + 100000;
                    }
                }

                const formattedPrice = 'Rp ' + harga.toLocaleString('id-ID');
                totalCostElement.textContent = formattedPrice;
                document.getElementById('confirmTotalHarga').textContent = formattedPrice;
                hiddenTotalInput.value = harga;
            }

            hitungHarga();
            jumlahPenghuni.addEventListener('change', hitungHarga);
            paymentType.addEventListener('change', hitungHarga);

            // Multi-step form navigation
            const step1Content = document.getElementById('step1Content');
            const step2Content = document.getElementById('step2Content');
            const step3Content = document.getElementById('step3Content');
            const progressFill = document.getElementById('progressFill');

            document.getElementById('nextToStep2').addEventListener('click', function() {
                // Validate step 1
                const tanggal = document.getElementById('tanggal_sewa').value;
                if (!tanggal) {
                    alert('Silakan pilih tanggal mulai sewa.');
                    return;
                }

                // Update confirmation data
                document.getElementById('confirmNama').textContent = document.getElementById('nama').value;
                document.getElementById('confirmEmail').textContent = document.getElementById('email')
                    .value;
                document.getElementById('confirmHp').textContent = document.getElementById('no_hp').value;
                document.getElementById('confirmAlamat').textContent = document.getElementById('alamat')
                    .value;
                document.getElementById('confirmTipePembayaran').textContent =
                    document.getElementById('tipe_pembayaran').options[document.getElementById(
                        'tipe_pembayaran').selectedIndex].text;
                document.getElementById('confirmJmlPenghuni').textContent =
                    document.getElementById('jumlah_penghuni').options[document.getElementById(
                        'jumlah_penghuni').selectedIndex].text;
                document.getElementById('confirmTanggalSewa').textContent = tanggal;

                // Show step 2
                step1Content.classList.add('d-none');
                step2Content.classList.remove('d-none');
                document.getElementById('step2').classList.add('active');
                document.querySelector('#step2 + .step-label').classList.add('active');
                progressFill.style.width = '50%';
            });

            document.getElementById('backToStep1').addEventListener('click', function() {
                step2Content.classList.add('d-none');
                step1Content.classList.remove('d-none');
                document.getElementById('step2').classList.remove('active');
                document.querySelector('#step2 + .step-label').classList.remove('active');
                progressFill.style.width = '0%';
            });

            document.getElementById('nextToStep3').addEventListener('click', function() {
                step2Content.classList.add('d-none');
                step3Content.classList.remove('d-none');
                document.getElementById('step3').classList.add('active');
                document.querySelector('#step3 + .step-label').classList.add('active');
                progressFill.style.width = '100%';
            });

            document.getElementById('backToStep2').addEventListener('click', function() {
                step3Content.classList.add('d-none');
                step2Content.classList.remove('d-none');
                document.getElementById('step3').classList.remove('active');
                document.querySelector('#step3 + .step-label').classList.remove('active');
                progressFill.style.width = '50%';
            });

            // Form submission
            document.getElementById('bookingForm').addEventListener('submit', function(e) {
                const submitButton = document.getElementById('submitBooking');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Memproses...';
                submitButton.disabled = true;
            });

            // Copy to clipboard function
            window.copyToClipboard = function(text) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('Nomor rekening berhasil disalin: ' + text);
                }, function(err) {
                    console.error('Gagal menyalin teks: ', err);
                });
            };

            // File upload preview
            const fileInput = document.getElementById('bukti_pembayaran');
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file maksimal 2MB');
                        this.value = '';
                        return;
                    }

                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png'];
                    if (!validTypes.includes(file.type)) {
                        alert('Hanya file JPG/PNG yang diperbolehkan');
                        this.value = '';
                        return;
                    }

                    // You can add preview functionality here if needed
                    console.log('File selected:', file.name);
                }
            });
        });
    </script>
</body>

</html>
