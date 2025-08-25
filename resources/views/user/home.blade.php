@extends('layouts.main')

@section('content')
    <!-- Halaman Home -->
    <section id="home" style="background-color: #f8f9fa; padding-top: 46px;">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero" style="background-image: url('/images/image1.jpg');">
                        <h1>Nyaman, Aman, Serasa di Rumah!</h1>
                        <p>Rasakan kemudahan pemesanan dan pembayaran secara digital</p>
                        <a href="#room" class="btn btn-lg btn-success rounded-pill shadow-sm px-4 py-2"
                            style="background-color: #28a745; border-color: #28a745;"
                            onmouseover="this.style.backgroundColor='#218838';"
                            onmouseout="this.style.backgroundColor='#28a745';">
                            <i class="fas fa-door-open me-2"></i>Lihat Kamar
                        </a>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="hero" style="background-image: url('/images/Tampak Kost Kamar 1 (Angle 3).jpg');">
                        <h1>Tempat yang Nyaman</h1>
                        <p>Kost dengan fasilitas lengkap dan harga terjangkau</p>
                        <div>
                            <a href="#room" class="btn btn-lg btn-success rounded-pill shadow-sm px-4 py-2"
                            style="background-color: #28a745; border-color: #28a745;"
                            onmouseover="this.style.backgroundColor='#218838';"
                            onmouseout="this.style.backgroundColor='#28a745';">
                            <i class="fas fa-bed me-2"></i>Lihat Kamar
                        </a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="hero" style="background-image: url('/images/tampak depan-3.png');">
                        <h1>Lokasi Strategis</h1>
                        <p>Dekat dengan pusat kota dan fasilitas umum</p>
                        <a href="#room" class="btn btn-lg btn-success rounded-pill shadow-sm px-4 py-2"
                            style="background-color: #28a745; border-color: #28a745;"
                            onmouseover="this.style.backgroundColor='#218838';"
                            onmouseout="this.style.backgroundColor='#28a745';">
                            <i class="fas fa-map-marker-alt me-2"></i>Lihat Kamar
                        </a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
    <!-- Halaman About -->
    <section id="about" style="background-color: #e9ecef; padding-top: 34px; padding-bottom: 34px;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="text-success">LAYANAN KOST YANG DAPAT DIANDALKAN</h5>
                    <h2>Kenyamanan Anda adalah Prioritas Kami</h2>
                    <p>
                        Kost Putri Alfia Purwokerto adalah tempat tinggal nyaman untuk perempuan yang berlokasi strategis di
                        Jl. Sokabaru IV No. 24, RT.002/RW.004, Kel. Berkoh, Kec. Purwokerto Selatan, Kab. Banyumas, Jawa Tengah.
                    </p>
                    <p>
                        Kost ini menyediakan fasilitas lengkap, seperti kamar dengan pilihan kamar mandi dalam atau luar,
                        garasi, Wi-Fi, dapur bersama, dan area jemuran, sehingga cocok untuk mahasiswa dan pekerja.
                    </p>
                    <p>
                        Dengan sistem manajemen berbasis website, penghuni dapat dengan mudah memesan kamar dan melakukan
                        pembayaran secara digital, membuat tinggal di kost ini menjadi lebih praktis dan teratur.
                    </p>
                    <a href="#contact" class="btn btn-outline-success">Hubungi Kami</a>
                </div>
                <div class="col-md-6">
                    <img src="/images/tampak depan-1.jpg" alt="Kost Putri Alfia" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </section>

    <!-- Halaman Room -->
    <section id="room" style="background-color: #f8f9fa; padding-top: 34px; padding-bottom: 10px;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="text-success">PILIH KAMAR SESUAI KEBUTUHAN ANDA</h5>
                        <h2>Pemesanan dan Pembayaran Kamar Secara Online Yang Mudah!</h2>
                    </div>
                    <a href="{{ route('user.listroom') }}" class="btn btn-outline-success rounded-pill"
                        style="border-color: #28a745;"
                        onmouseover="this.style.backgroundColor='#28a745'; this.style.borderColor='#28a745';"
                        onmouseout="this.style.backgroundColor='transparent'; this.style.borderColor='#28a745';">
                        Selengkapnya &rarr;
                    </a>
                </div>
                @foreach ($rooms->take(4) as $kamar)
                    <div class="col-md-4 mb-4">
                        <div class="card room-card h-100">
                            <div class="position-relative">
                                @if ($kamar->gambar)
                                    <img src="{{ asset('storage/' . $kamar->gambar) }}" class="card-img-top room-img"
                                        alt="Kamar {{ $kamar->no_kamar }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                                        class="card-img-top room-img" alt="Kamar {{ $kamar->no_kamar }}">
                                @endif
                                <span
                                    class="position-absolute top-0 end-0 mt-3 mr-2s badge
                                {{ $kamar->status == 'available' ? 'bg-success' : 'bg-danger' }}
                                text-white px-3 py-1 rounded-pill">
                                    {{ $kamar->status == 'available' ? 'Tersedia' : 'Booked' }}
                                </span>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="card-title mb-0">Kamar {{ $kamar->no_kamar }}</h5>
                                    <h5 class="text-success mb-0">Rp {{ number_format($kamar->harga, 0, ',', '.') }}</h5>
                                </div>

                                <div class="mb-3">
                                    <div class="d-flex align-items-center text-muted mb-2">
                                        <i class="fas fa-home me-2"></i>
                                        <span>Fasilitas Kamar</span>
                                    </div>

                                    <div class="d-flex flex-wrap">
                                        @foreach (explode(',', $kamar->fasilitas) as $fasilitas)
                                            <span class="badge bg-primary-light text-primary facility-badge me-1 mb-1">
                                                <i class="fas fa-check me-1"></i>{{ trim($fasilitas) }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>

                                <a href="{{ $kamar->status == 'booked' ? '#' : route('user.detailroom', $kamar->id) }}"
                                    class="btn mt-auto
                                        {{ $kamar->status == 'available' ? 'btn-success' : 'btn-secondary' }}
                                        {{ $kamar->status == 'booked' ? 'cursor-not-allowed opacity-50' : '' }}"
                                    id="kamar-{{ $kamar->id }}"
                                    {{ $kamar->status == 'booked' ? 'onclick="event.preventDefault();"' : '' }}>
                                    <i class="fas fa-eye me-2"></i>Lihat Detail
                                </a>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>
    <!-- Halaman Contact -->
    <section id="contact" style="background-color: #ffffff; padding-top: 34px;  padding-bottom: 30px;">
        <div class="container py-5">
            <div class="row">
                <!-- Form Kontak -->
                <div class="col-md-6">
                    <h5 class="text-success">HUBUNGI KAMI</h5>
                    <h2>Kami Siap Membantu Anda!</h2>
                    <div class="mt-3">
                        <p><i class="bi bi-envelope"></i> alfiakostpurwokerto@gmail.com</p>
                        <p><i class="bi bi-telephone"></i> +62 896 3043 3177</p>
                        <h5>Lokasi</h5>
                        <p>Jl. Sokabaru IV No. 24, RT.002/RW.004, Kel. Berkoh, Kec. Purwokerto Selatan, Kab. Banyumas, Jawa Tengah</p>
                        <h5>Jam Operasional</h5>
                        <p>Senin - Minggu : 8:00 WIB - 21:00 WIB</p>
                    </div>
                </div>
                <!-- Informasi Lokasi -->
                <div class="col-md-6">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.2571201859623!2d109.26020079999999!3d-7.436776200000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655dec604ab5f3%3A0xa298098fcd67273a!2sAlfia%20Kost%20Putri!5e0!3m2!1sid!2sid!4v1736778530454!5m2!1sid!2sid"
                        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
@endsection
