<!-- Button Edit Kamar -->
<button type="button"
    class="bg-yellow-500 text-white p-2 rounded-full hover:bg-yellow-600 transition-colors duration-200"
    onclick="openEditModal({{ $item->id }}, '{{ $item->no_kamar }}', '{{ $item->harga }}', '{{ $item->deskripsi_kamar }}', {{ json_encode($item->fasilitas) }}, '{{ $item->status }}', '{{ $item->gambar ? asset('storage/' . $item->gambar) : '' }}')">
    <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg">
        <path
            d="M3.25 22C3.25 21.5858 3.58579 21.25 4 21.25H20C20.4142 21.25 20.75 21.5858 20.75 22C20.75 22.4142 20.4142 22.75 20 22.75H4C3.58579 22.75 3.25 22.4142 3.25 22Z"
            fill="currentColor"></path>
        <path
            d="M11.5201 14.929L17.4368 9.01225C16.6315 8.6771 15.6777 8.12656 14.7757 7.22455C13.8736 6.32238 13.323 5.36846 12.9879 4.56312L7.07106 10.4799C6.60932 10.9417 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L8.38334 16.8676C9.00281 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0584 15.3907 11.5201 14.929Z"
            fill="currentColor"></path>
        <path
            d="M19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142L13.9199 3.63105C13.9296 3.6604 13.9397 3.69015 13.9502 3.72028C14.2103 4.47 14.701 5.45281 15.6243 6.37602C16.5475 7.29923 17.5303 7.78999 18.28 8.05009C18.31 8.0605 18.3396 8.07054 18.3688 8.08021L19.0786 7.37044Z"
            fill="currentColor"></path>
    </svg>
    <span class="sr-only">Edit Kamar</span>
</button>

<!-- Modal Edit Kamar -->
<div id="editKamarModal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-4 max-h-[90vh] overflow-y-auto">
        <h2 class="text-xl font-semibold mb-4">Edit Kamar</h2>

        <form id="editKamarForm" method="POST" action="{{ route('kamar.update', ['id' => '__ID__']) }}"
            enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="edit_id">

            <!-- No Kamar -->
            <div>
                <label for="edit_no_kamar" class="block text-sm font-medium text-gray-700 mb-1">No Kamar</label>
                <input type="text" name="no_kamar" id="edit_no_kamar" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Harga -->
            <div>
                <label for="edit_harga" class="block text-sm font-medium text-gray-700 mb-1">Harga</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">Rp</span>
                    <input type="number" name="harga" id="edit_harga" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 pl-8 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label for="edit_deskripsi_kamar" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi_kamar" id="edit_deskripsi_kamar" rows="3" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Fasilitas -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                <div class="mt-2 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas1" name="fasilitas[]" value="Kamar Mandi Dalam"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas1" class="ml-2 block text-sm text-gray-900">Kamar Mandi Dalam</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas2" name="fasilitas[]" value="Kamar Mandi Luar"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas2" class="ml-2 block text-sm text-gray-900">Kamar Mandi Luar</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas3" name="fasilitas[]" value="Jendela"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas3" class="ml-2 block text-sm text-gray-900">Jendela</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas4" name="fasilitas[]" value="Kasur"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas4" class="ml-2 block text-sm text-gray-900">Kasur</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas5" name="fasilitas[]" value="Bantal"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas5" class="ml-2 block text-sm text-gray-900">Bantal</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas6" name="fasilitas[]" value="Lemari"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas6" class="ml-2 block text-sm text-gray-900">Lemari</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas7" name="fasilitas[]" value="Laci"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas7" class="ml-2 block text-sm text-gray-900">Laci</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas8" name="fasilitas[]" value="Rak Sepatu"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas8" class="ml-2 block text-sm text-gray-900">Rak Sepatu</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas9" name="fasilitas[]" value="Kipas Angin"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas9" class="ml-2 block text-sm text-gray-900">Kipas Angin</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="edit_fasilitas10" name="fasilitas[]" value="Wifi"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="edit_fasilitas10" class="ml-2 block text-sm text-gray-900">Wifi</label>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="edit_status"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="available">Available</option>
                    <option value="booked">Booked</option>
                </select>
            </div>

            <!-- Kapasitas -->
            <div>
                <label for="edit_kapasitas" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas</label>
                <select name="kapasitas" id="edit_kapasitas" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Pilih Kapasitas</option>
                    <option value="1" {{ isset($item->kapasitas) && $item->kapasitas == 1 ? 'selected' : '' }}>1
                        Orang</option>
                    <option value="2" {{ isset($item->kapasitas) && $item->kapasitas == 2 ? 'selected' : '' }}>2
                        Orang</option>
                    <option value="3" {{ isset($item->kapasitas) && $item->kapasitas == 3 ? 'selected' : '' }}>3
                        Orang</option>
                    <option value="4" {{ isset($item->kapasitas) && $item->kapasitas == 4 ? 'selected' : '' }}>4
                        Orang</option>
                    <option value="5" {{ isset($item->kapasitas) && $item->kapasitas == 5 ? 'selected' : '' }}>5
                        Orang</option>
                </select>
            </div>

            <!-- Gambar -->
            <div>
                <label for="edit_gambar" class="block text-sm font-medium text-gray-700 mb-1">Gambar</label>
                <input type="file" name="gambar" id="edit_gambar"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 file:mr-2 file:py-1 file:px-3 file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                    accept="image/*" onchange="previewEditImage(event)">

                <div class="mt-3 space-y-2">
                    <div id="current_image_container" class="hidden">
                        <p class="text-sm text-gray-500 mb-1">Gambar Saat Ini:</p>
                        <img id="current_image" src="" alt="Gambar Saat Ini"
                            class="w-full h-48 object-cover rounded border border-gray-300">
                    </div>
                    <div id="preview_container" class="hidden">
                        <p class="text-sm text-gray-500 mb-1">Preview Gambar Baru:</p>
                        <img id="preview_gambar" src="#" alt="Preview Gambar Baru"
                            class="w-full h-48 object-cover rounded border border-blue-300">
                    </div>
                    <div id="no_image" class="text-gray-500 text-sm py-4 text-center border border-dashed rounded">
                        Tidak ada gambar
                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3 pt-4">
                <button type="button" id="closeEditModalBtn"
                    class="bg-gray-300 text-white px-4 py-2 rounded-full hover:bg-gray-600">Batal</button>
                <button type="submit"
                    class="px-4 py-2 border border-transparent rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script>
        function openEditModal(id, no_kamar, harga, deskripsi_kamar, fasilitas, status, gambarUrl) {
            // Set form action dengan ID yang benar
            const form = document.getElementById('editKamarForm');
            form.action = form.action.replace('__ID__', id);

            // Set nilai input
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_no_kamar').value = no_kamar;
            document.getElementById('edit_harga').value = harga;
            document.getElementById('edit_deskripsi_kamar').value = deskripsi_kamar;
            document.getElementById('edit_status').value = status;

            // Reset semua checkbox fasilitas
            document.querySelectorAll('input[name="fasilitas[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Handle fasilitas dengan lebih robust
            if (fasilitas) {
                let fasilitasArray = [];

                try {
                    // Coba parse sebagai JSON jika mungkin
                    if (typeof fasilitas === 'string' && (fasilitas.startsWith('[') || fasilitas.startsWith('{'))) {
                        fasilitasArray = JSON.parse(fasilitas.replace(/'/g, '"'));
                    } else if (Array.isArray(fasilitas)) {
                        fasilitasArray = fasilitas;
                    } else if (typeof fasilitas === 'string') {
                        // Fallback ke pemisah koma
                        fasilitasArray = fasilitas.split(',').map(item => item.trim());
                    }
                } catch (e) {
                    console.error('Error parsing fasilitas:', e);
                }

                // Set checkbox fasilitas yang aktif
                fasilitasArray.forEach(f => {
                    if (f) {
                        
const fasilitasMap = {
    'Kamar Mandi Dalam': 'edit_fasilitas1',
    'Kamar Mandi Luar': 'edit_fasilitas2',
    'Jendela': 'edit_fasilitas3',
    'Kasur': 'edit_fasilitas4',
    'Bantal': 'edit_fasilitas5',
    'Lemari': 'edit_fasilitas6',
    'Laci': 'edit_fasilitas7',
    'Rak Sepatu': 'edit_fasilitas8',
    'Kipas Angin': 'edit_fasilitas9',
    'Wifi': 'edit_fasilitas10',
};

const id = fasilitasMap[f];
if (id) {
    const element = document.getElementById(id);
    if (element) {
        element.checked = true;
    }
}

                    }
                });
            }

            // Handle preview gambar
            const currentImageContainer = document.getElementById('current_image_container');
            const currentImage = document.getElementById('current_image');
            const noImage = document.getElementById('no_image');
            const previewContainer = document.getElementById('preview_container');
            const preview = document.getElementById('preview_gambar');

            // Reset preview
            preview.src = '#';
            previewContainer.classList.add('hidden');
            currentImageContainer.classList.add('hidden');
            document.getElementById('edit_gambar').value = '';

            if (gambarUrl) {
                currentImage.src = gambarUrl;
                currentImageContainer.classList.remove('hidden');
                noImage.classList.add('hidden');
            } else {
                currentImageContainer.classList.add('hidden');
                noImage.classList.remove('hidden');
            }

            // Tampilkan modal
            document.getElementById('editKamarModal').classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }

        function previewEditImage(event) {
            const preview = document.getElementById('preview_gambar');
            const previewContainer = document.getElementById('preview_container');
            const currentImageContainer = document.getElementById('current_image_container');
            const noImage = document.getElementById('no_image');

            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                    currentImageContainer.classList.add('hidden');
                    noImage.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                previewContainer.classList.add('hidden');
                if (document.getElementById('current_image').src) {
                    currentImageContainer.classList.remove('hidden');
                    noImage.classList.add('hidden');
                } else {
                    noImage.classList.remove('hidden');
                }
            }
        }

        // Perbaikan pada form submission
        document.getElementById('editKamarForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Validasi client-side yang lebih longgar
            const noKamar = document.getElementById('edit_no_kamar').value.trim();
            const harga = document.getElementById('edit_harga').value.trim();
            const deskripsi = document.getElementById('edit_deskripsi_kamar').value.trim();

            if (!noKamar || !harga || !deskripsi) {
                alert('Harap isi nomor kamar, harga, dan deskripsi!');
                return;
            }

            // Submit form
            this.submit();
        });

        document.getElementById('closeEditModalBtn').addEventListener('click', function() {
            document.getElementById('editKamarModal').classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        });
    </script>
@endpush
