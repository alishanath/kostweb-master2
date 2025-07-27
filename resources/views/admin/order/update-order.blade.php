<!-- Button Edit Pesanan -->
<button type="button"
    class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600 transition-colors duration-200 edit-pesanan-btn"
    data-id="{{ $pesanan->id }}" data-penghuni_id="{{ $pesanan->penghuni_id }}" data-kamar_id="{{ $pesanan->kamar_id }}"
    data-tanggal_sewa="{{ \Carbon\Carbon::parse($pesanan->tanggal_sewa)->format('Y-m-d') }}"
    data-status="{{ $pesanan->status }}" data-catatan="{{ $pesanan->catatan ?? '' }}">
    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3.25 22C3.25 21.5858 3.58579 21.25 4 21.25H20C20.4142 21.25 20.75 21.5858 20.75 22C20.75 22.4142 20.4142 22.75 20 22.75H4C3.58579 22.75 3.25 22.4142 3.25 22Z"
            fill="#ffffff"></path>
        <path
            d="M11.5201 14.929L17.4368 9.01225C16.6315 8.6771 15.6777 8.12656 14.7757 7.22455C13.8736 6.32238 13.323 5.36846 12.9879 4.56312L7.07106 10.4799C6.60932 10.9417 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L8.38334 16.8676C9.00281 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0584 15.3907 11.5201 14.929Z"
            fill="#ffffff"></path>
        <path
            d="M19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142L13.9199 3.63105C13.9296 3.6604 13.9397 3.69015 13.9502 3.72028C14.2103 4.47 14.701 5.45281 15.6243 6.37602C16.5475 7.29923 17.5303 7.78999 18.28 8.05009C18.31 8.0605 18.3396 8.07054 18.3688 8.08021L19.0786 7.37044Z"
            fill="#ffffff"></path>
    </svg>
    <span class="sr-only">Edit Pesanan</span>
</button>

{{-- <button type="button"
    class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600 transition-colors duration-200 edit-pesanan-btn"
    data-id="{{ $pesanan->id }}" data-penghuni_id="{{ $pesanan->penghuni_id }}" data-kamar_id="{{ $pesanan->kamar_id }}"
    data-tanggal_sewa="{{ $pesanan->tanggal_sewa }}" data-status="{{ $pesanan->status }}"
    data-catatan="{{ $pesanan->catatan }}">
    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3.25 22C3.25 21.5858 3.58579 21.25 4 21.25H20C20.4142 21.25 20.75 21.5858 20.75 22C20.75 22.4142 20.4142 22.75 20 22.75H4C3.58579 22.75 3.25 22.4142 3.25 22Z"
            fill="#ffffff"></path>
        <path
            d="M11.5201 14.929L17.4368 9.01225C16.6315 8.6771 15.6777 8.12656 14.7757 7.22455C13.8736 6.32238 13.323 5.36846 12.9879 4.56312L7.07106 10.4799C6.60932 10.9417 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L8.38334 16.8676C9.00281 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0584 15.3907 11.5201 14.929Z"
            fill="#ffffff"></path>
        <path
            d="M19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142L13.9199 3.63105C13.9296 3.6604 13.9397 3.69015 13.9502 3.72028C14.2103 4.47 14.701 5.45281 15.6243 6.37602C16.5475 7.29923 17.5303 7.78999 18.28 8.05009C18.31 8.0605 18.3396 8.07054 18.3688 8.08021L19.0786 7.37044Z"
            fill="#ffffff"></path>
    </svg>
    <span class="sr-only">Edit Pesanan</span>
</button> --}}

<!-- Modal Edit Pesanan -->
<div id="editPesananModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/2 lg:w-1/3 relative max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4">Edit Pesanan</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-2 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form id="editPesananForm" method="POST" action="{{ route('pemesanan.update', $pesanan->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_pesanan_id">

            {{-- tampilkan kode booking namun tidak bisa diubah --}}
            <div class="mb-4">
                <label for="edit_kode_booking" class="block text-sm font-medium text-gray-700">Kode Booking</label>
                <input type="text" name="kode_booking" id="edit_kode_booking" value="{{ $pesanan->kode_booking }}"
                    readonly class="w-full border rounded px-3 py-2 bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Resident Selection -->
            <div class="mb-4">
                <label for="edit_penghuni_id" class="block text-sm font-medium text-gray-700">Nama Penghuni</label>
                <select name="penghuni_id" id="edit_penghuni_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Penghuni --</option>
                    @foreach ($penghuni as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_lengkap ?? $item->name }}
                        </option>
                    @endforeach
                </select>
                @error('penghuni_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Room Selection -->
            <div class="mb-4">
                <label for="edit_kamar_id" class="block text-sm font-medium text-gray-700">No Kamar</label>
                <select name="kamar_id" id="edit_kamar_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih No Kamar --</option>

                    {{-- Kamar yang sedang dipilih (kamar lama) --}}
                    @php
                        $kamarDipilih = $kamars->firstWhere('id', $pesanan->kamar_id);
                    @endphp
                    @if ($kamarDipilih)
                        <option value="{{ $kamarDipilih->id }}" data-status="{{ $kamarDipilih->status }}"
                            data-harga="{{ $kamarDipilih->harga }}"
                            data-fasilitas="{{ strtolower($kamarDipilih->fasilitas) }}" selected>
                            {{ $kamarDipilih->no_kamar }} ({{ $kamarDipilih->status }}) - Sedang Dipilih
                        </option>
                    @endif

                    {{-- Kamar lainnya yang hanya available --}}
                    @foreach ($kamars as $kamar)
                        @if ($kamar->status === 'available' && $kamar->id !== $pesanan->kamar_id)
                            <option value="{{ $kamar->id }}" data-status="{{ $kamar->status }}"
                                data-harga="{{ $kamar->harga }}" data-fasilitas="{{ strtolower($kamar->fasilitas) }}">
                                {{ $kamar->no_kamar }} ({{ $kamar->status }})
                            </option>
                        @endif
                    @endforeach
                </select>

                @error('kamar_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <!-- Tanggal sewa -->

            <div class="mb-4">
                <label for="edit_tanggal_sewa" class="block text-sm font-medium text-gray-700">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="edit_tanggal_sewa" required
                    value="{{ old('tanggal_sewa', $pesanan->tanggal_sewa ? \Carbon\Carbon::parse($pesanan->tanggal_sewa)->format('Y-m-d') : '') }}"
                    min="{{ date('Y-m-d') }}" class="w-full border rounded px-3 py-2">
                @error('tanggal_sewa')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- jumlah penghuni --}}
            <div class="mb-4">
                <label for="jumlah_penghuni" class="block text-sm font-medium text-gray-700">Jumlah Penghuni</label>
                <select name="jumlah_penghuni" id="jumlah_penghuni" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Jumlah Penghuni --</option>
                    <option value="1"
                        {{ old('jumlah_penghuni', $pesanan->jumlah_penghuni) == 1 ? 'selected' : '' }}>1 Orang</option>
                    <option value="2"
                        {{ old('jumlah_penghuni', $pesanan->jumlah_penghuni) == 2 ? 'selected' : '' }}>2 Orang</option>
                </select>
                @error('jumlah_penghuni')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- tipe pembayaran bulanan dan Mingguan --}}
            <div class="mb-4">
                <label for="tipe_pembayaran" class="block text-sm font-medium text-gray-700">Tipe Pembayaran</label>
                <select name="tipe_pembayaran" id="tipe_pembayaran" required class="w-full border rounded px-3 py-2">
                    <option value="bulanan"
                        {{ old('tipe_pembayaran', $pesanan->tipe_pembayaran) == 'bulanan' ? 'selected' : '' }}>
                        Bulanan</option>
                    <option value="Mingguan"
                        {{ old('tipe_pembayaran', $pesanan->tipe_pembayaran) == 'Mingguan' ? 'selected' : '' }}>
                        Mingguan</option>
                </select>
                @error('tipe_pembayaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- total pembayaran --}}

            <div class="mb-4">
                <label for="total_pembayaran" class="block text-sm font-medium text-gray-700">Total Pembayaran</label>
                <input type="number" name="total_pembayaran" id="total_pembayaran" required
                    value="{{ old('total_pembayaran', $pesanan->total_pembayaran) }}"
                    class="w-full border rounded px-3 py-2">
                @error('total_pembayaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Payment Proof (Optional Update) -->
            @if ($pesanan->bukti_pembayaran)
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Bukti Pembayaran Lama</label>
                    @if (Str::endsWith(strtolower($pesanan->bukti_pembayaran), ['.jpg', '.jpeg', '.png', '.gif']))
                        <img src="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" alt="Bukti Pembayaran Lama"
                            class="w-32 h-32 object-cover rounded mb-2 border">
                    @elseif(Str::endsWith(strtolower($pesanan->bukti_pembayaran), ['.pdf']))
                        <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                            class="text-blue-500 underline">Lihat Bukti Pembayaran (PDF)</a>
                    @else
                        <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                            class="text-blue-500 underline">Download Bukti Pembayaran</a>
                    @endif
                </div>
            @endif

            <!-- Upload Bukti Pembayaran Baru (Opsional) -->
            <div class="mb-4">
                <label for="edit_bukti_pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran
                    Baru
                    (Opsional)</label>
                <input type="file" name="bukti_pembayaran" id="edit_bukti_pembayaran" accept="image/*,.pdf"
                    class="w-full border rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, PDF (Max: 10MB)</p>
                @error('bukti_pembayaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Selection -->
            <div class="mb-4">
                <label for="edit_status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="edit_status" required class="w-full border rounded px-3 py-2">
                    <option value="Menunggu">Menunggu</option>
                    <option value="Diterima">Diterima</option>
                    <option value="Ditolak">Ditolak</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="closeEditPesananModalBtn"
                    class="px-4 py-2 border rounded-full hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editPesananModal');
            const closeBtn = document.getElementById('closeEditPesananModalBtn');
            const editForm = document.getElementById('editPesananForm');
            const kamarSelect = document.getElementById('edit_kamar_id');
            const jumlahPenghuniInput = document.getElementById('jumlah_penghuni');
            const tipePembayaranSelect = document.getElementById('tipe_pembayaran');
            const totalPembayaranInput = document.getElementById('total_pembayaran');
            let kamarIdLama = null;

            // === Buka modal ===
            document.querySelectorAll('.edit-pesanan-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const penghuniId = this.getAttribute('data-penghuni_id');
                    const kamarId = this.getAttribute('data-kamar_id');
                    const tanggalSewa = this.getAttribute('data-tanggal_sewa');
                    const status = this.getAttribute('data-status');

                    kamarIdLama = kamarId;

                    editForm.action = "{{ route('pemesanan.update', ['id' => '__ID__']) }}"
                        .replace('__ID__', id);

                    document.getElementById('edit_pesanan_id').value = id;
                    document.getElementById('edit_penghuni_id').value = penghuniId || '';
                    document.getElementById('edit_kamar_id').value = kamarId || '';
                    document.getElementById('edit_tanggal_sewa').value = tanggalSewa || '';
                    document.getElementById('edit_status').value = status || 'Menunggu';

                    editModal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');

                    hitungTotal(); // Hitung harga saat modal dibuka
                });
            });

            // Tutup modal
            closeBtn.addEventListener('click', function() {
                editModal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });

            // Klik di luar modal
            editModal.addEventListener('click', function(e) {
                if (e.target === editModal) {
                    editModal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            });

            // Validasi kamar booked
            kamarSelect?.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedStatus = selectedOption.dataset.status;

                if (selectedStatus === 'booked' && this.value !== kamarIdLama) {
                    alert('Kamar ini sudah dipesan! Silakan pilih kamar lain.');
                    this.value = '';
                }
                hitungTotal();
            });

            // Event hitung ulang jika input berubah
            jumlahPenghuniInput.addEventListener('input', hitungTotal);
            tipePembayaranSelect.addEventListener('change', hitungTotal);

            // Validasi tanggal sewa
            document.getElementById('edit_tanggal_sewa')?.addEventListener('change', function() {
                if (new Date(this.value) < new Date(new Date().toDateString())) {
                    alert('Tanggal sewa tidak boleh kurang dari hari ini!');
                    this.value = '';
                }
            });

            // Validasi submit
            editForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const penghuniId = document.getElementById('edit_penghuni_id').value.trim();
                const kamarId = document.getElementById('edit_kamar_id').value.trim();
                const tanggalSewa = document.getElementById('edit_tanggal_sewa').value.trim();

                if (!penghuniId || !kamarId || !tanggalSewa) {
                    alert('Mohon lengkapi semua data utama.');
                    return;
                }
                this.submit();
            });

            // === Fungsi Hitung Harga ===
            function hitungTotal() {
                const selectedOption = kamarSelect.options[kamarSelect.selectedIndex];
                if (!selectedOption) return;

                const hargaDb = parseInt(selectedOption.dataset.harga || 0);
                const fasilitas = (selectedOption.dataset.fasilitas || '').toLowerCase();
                const jumlahPenghuni = parseInt(jumlahPenghuniInput.value || 1);
                const tipePembayaran = tipePembayaranSelect.value;

                let total = 0;

                if (fasilitas.includes('dalam')) {
                    if (tipePembayaran === 'bulanan') {
                        total = hargaDb + (jumlahPenghuni > 1 ? 100000 : 0);
                    } else { // mingguan
                        total = 175000 + (jumlahPenghuni > 1 ? 100000 : 0);
                    }
                } else if (fasilitas.includes('luar')) {
                    if (tipePembayaran === 'bulanan') {
                        total = hargaDb + (jumlahPenghuni > 1 ? 100000 : 0);
                    } else { // mingguan
                        total = 150000 + (jumlahPenghuni > 1 ? 100000 : 0);
                    }
                }

                totalPembayaranInput.value = total;
            }
        });
    </script>
@endpush
