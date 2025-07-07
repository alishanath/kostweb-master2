{{-- Modal Tambah Penghuni --}}
<div id="tambahPenghuniModal"
    class="hidden fixed inset-0 bg-gray-800 bg-opacity-40 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Tambah Penghuni</h2>

        {{-- Flash Message --}}
        @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-2 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form id="tambahPenghuniForm" action="{{ route('penghuni.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <div>
                <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" id="nama_lengkap" required value="{{ old('nama_lengkap') }}"
                    class="w-full border rounded px-3 py-2">
                @error('nama_lengkap')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No Hp</label>
                <input type="text" name="no_hp" id="no_hp" required value="{{ old('no_hp') }}"
                    class="w-full border rounded px-3 py-2">
                @error('no_hp')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                    class="w-full border rounded px-3 py-2">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" required
                    value="{{ old('tanggal_lahir') }}" class="w-full border rounded px-3 py-2">
                @error('tanggal_lahir')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                <textarea name="alamat" id="alamat" rows="4" class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn"
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded-full hover:bg-gray-400">Batal</button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">Tambah</button>
            </div>
        </form>
    </div>
</div>



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addPenghuniBtn = document.getElementById('addPenghuniBtn');
            const closeModalBtn = document.getElementById('closeModalBtn');
            const modal = document.getElementById('tambahPenghuniModal'); // Modal ID for Penghuni

            if (addPenghuniBtn && modal && closeModalBtn) {
                console.log('Elements found, attaching event listeners.');

                addPenghuniBtn.addEventListener('click', function() {
                    console.log('Add Penghuni button clicked');
                    modal.classList.remove('hidden'); // Show modal
                });

                closeModalBtn.addEventListener('click', function() {
                    console.log('Close Modal button clicked');
                    modal.classList.add('hidden');
                    form.reset();
                });
            } else {
                console.log('Elements not found');
            }
        });
    </script>
@endpush
