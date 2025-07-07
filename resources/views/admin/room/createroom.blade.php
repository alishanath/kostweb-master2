{{-- Modal Tambah Kamar --}}

<div id="tambahKamarModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-md w-1/3">
        <h2 class="text-xl font-semibold mb-4">Tambah Kamar</h2>
        <form id="tambahKamarForm" action="{{ route('kamar.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4">
            @csrf
            <div>
                <label for="no_kamar" class="block text-sm font-medium text-gray-700">No Kamar</label>
                <input type="text" name="no_kamar" id="no_kamar" required
                    class="w-full border rounded px-3 py-2 @error('no_kamar') border-red-500 @enderror"
                    value="{{ old('no_kamar', $kamar->no_kamar ?? '') }}">

                @error('no_kamar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
                <input type="text" name="harga" id="harga" required class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label for="deskripsi_kamar" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="deskripsi_kamar" id="deskripsi_kamar" required class="w-full border rounded px-3 py-2"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Fasilitas</label>
                <div class="mt-2 flex flex-wrap gap-4"> <!-- Ubah ke flex dan tambahkan gap -->
                    <div class="flex items-center">
                        <input type="checkbox" id="fasilitas1" name="fasilitas[]" value="AC"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="fasilitas1" class="ml-2 block text-sm text-gray-900">AC</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="fasilitas2" name="fasilitas[]" value="WiFi"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="fasilitas2" class="ml-2 block text-sm text-gray-900">WiFi</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="fasilitas3" name="fasilitas[]" value="TV"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="fasilitas3" class="ml-2 block text-sm text-gray-900">TV</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="fasilitas4" name="fasilitas[]" value="Kulkas"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="fasilitas4" class="ml-2 block text-sm text-gray-900">Kulkas</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="fasilitas5" name="fasilitas[]" value="kipas"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="fasilitas5" class="ml-2 block text-sm text-gray-900">Kipas Angin</label>
                    </div>
                </div>
            </div>
            <div>
                <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="w-full border rounded px-3 py-2">
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" id="closeModalBtn"
                    class="bg-gray-300 text-white px-4 py-2 rounded-full hover:bg-gray-600">Batal</button>
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">Tambah</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Show the modal
    document.getElementById('addRoomBtn').addEventListener('click', function() {
        document.getElementById('tambahKamarModal').classList.remove('hidden');
    });

    // Close the modal
    document.getElementById('closeModalBtn').addEventListener('click', function() {
        document.getElementById('tambahKamarModal').classList.add('hidden');
    });
    document.getElementById('closeEditModalBtn').addEventListener('click', function() {
        document.getElementById('editKamarModal').classList.add('hidden');
    });


    document.querySelectorAll('input[name="fasilitas[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', updateTabelFasilitas);
    });

    function updateTabelFasilitas() {
        const tabelBody = document.getElementById('tabelFasilitas');
        tabelBody.innerHTML = ''; // Kosongkan tabel

        // Ambil semua checkbox yang dicentang
        const checkedBoxes = document.querySelectorAll('input[name="fasilitas[]"]:checked');

        if (checkedBoxes.length === 0) {
            // Jika tidak ada yang dicentang, tampilkan pesan
            const row = document.createElement('tr');
            row.innerHTML =
                '<td colspan="2" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Belum ada fasilitas yang dipilih</td>';
            tabelBody.appendChild(row);
        } else {
            // Jika ada yang dicentang, tampilkan dalam tabel
            checkedBoxes.forEach((box, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${index + 1}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${box.value}</td>
                `;
                tabelBody.appendChild(row);
            });
        }
    }

    // Panggil fungsi pertama kali untuk inisialisasi
    updateTabelFasilitas();


    // Handle form submission
    document.getElementById('tambahKamarForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Perform your AJAX request here
        const formData = new FormData(this);
        fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Kamar berhasil ditambahkan!');
                    window.location.href = "{{ route('kamar') }}"; // Redirect to the table page
                } else {
                    alert('Terjadi kesalahan saat menambahkan kamar.');
                }
            })
            .catch(error => console.error('Error:', error));
    });
</script>
