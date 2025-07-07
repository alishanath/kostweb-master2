<div id="createOrderModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-full md:w-1/2 lg:w-1/3 relative">

        <h2 class="text-xl font-semibold mb-4">Buat Order</h2>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-2 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form id="createOrderForm" action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Resident Selection -->
            <div class="mb-4">
                <label for="penghuni_id" class="block text-sm font-medium text-gray-700">Nama Penghuni</label>
                <select name="penghuni_id" id="penghuni_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih Penghuni --</option>
                    @foreach ($penghuni as $item)
                        <option value="{{ $item->id }}" {{ old('penghuni_id') == $item->id ? 'selected' : '' }}>
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
                <label for="kamar_id" class="block text-sm font-medium text-gray-700">No Kamar</label>
                <select name="kamar_id" id="kamar_id" required class="w-full border rounded px-3 py-2">
                    <option value="">-- Pilih No Kamar --</option>
                    @foreach ($kamars as $kamar)
                        <option value="{{ $kamar->id }}" {{ old('kamar_id') == $kamar->id ? 'selected' : '' }}
                            data-status="{{ $kamar->status }}">
                            {{ $kamar->no_kamar }} ({{ $kamar->status }})
                        </option>
                    @endforeach
                </select>
                @error('kamar_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rental Date -->
            <div class="mb-4">
                <label for="tanggal_sewa" class="block text-sm font-medium text-gray-700">Tanggal Sewa</label>
                <input type="date" name="tanggal_sewa" id="tanggal_sewa" required value="{{ old('tanggal_sewa') }}"
                    min="{{ date('Y-m-d') }}" class="w-full border rounded px-3 py-2">
                @error('tanggal_sewa')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Payment Proof -->
            <div class="mb-4">
                <label for="bukti_pembayaran" class="block text-sm font-medium text-gray-700">Bukti Pembayaran</label>
                <input type="file" name="bukti_pembayaran" id="bukti_pembayaran" required accept="image/*,.pdf"
                    class="w-full border rounded px-3 py-2">
                <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, PDF (Max: 10MB)</p>
                @error('bukti_pembayaran')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status Selection -->
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" id="status" required class="w-full border rounded px-3 py-2">
                    <option value="Menunggu" {{ old('status', 'Menunggu') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                    </option>
                    <option value="Diterima" {{ old('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="Ditolak" {{ old('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" id="closeOrderModalBtn" class="px-4 py-2 border rounded-full hover:bg-gray-100">
                    Batal
                </button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-600">
                    Simpan Pemesanan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Toggle
            const toggleModal = (show = true) => {
                const modal = document.getElementById('createOrderModal');
                if (modal) {
                    modal.classList.toggle('hidden', !show);
                    if (!show) document.getElementById('createOrderForm').reset();
                }
            };

            // Event Listeners
            document.getElementById('addOrderBtn')?.addEventListener('click', () => toggleModal(true));
            document.getElementById('closeOrderModalBtn')?.addEventListener('click', () => toggleModal(false));

            // Room Status Validation
            document.getElementById('kamar_id')?.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.dataset.status === 'booked') {
                    alert('Kamar ini sudah dipesan! Silakan pilih kamar lain.');
                    this.value = '';
                }
            });

            // Date Validation
            document.getElementById('tanggal_sewa')?.addEventListener('change', function() {
                if (new Date(this.value) < new Date()) {
                    alert('Tanggal sewa tidak boleh kurang dari hari ini!');
                    this.value = '';
                }
            });
        });
    </script>
@endpush
