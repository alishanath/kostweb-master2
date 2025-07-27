@extends('layouts.index')
@section('title', 'Edit Profil')

@section('content')
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-xl shadow-md mt-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Profil</h2>

        <!-- Pesan sukses -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded-lg mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Validasi Error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            <!-- Nama -->
            <div>
                <label for="name" class="block text-gray-700 font-semibold mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- No HP -->
            <div>
                <label for="no_hp" class="block text-gray-700 font-semibold mb-1">No HP</label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-gray-700 font-semibold mb-1">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>{{ old('alamat', $user->alamat) }}</textarea>
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-gray-700 font-semibold mb-1">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                    value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <!-- Upload KTP -->
            <div>
                <label for="ktp" class="block text-gray-700 font-semibold mb-1">Upload Foto KTP (Opsional)</label>
                <input type="file" name="ktp" id="ktp"
                    class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500" accept="image/*"
                    onchange="previewImage(event)">

                <!-- Preview KTP -->
                <div class="mt-3">
                    <p class="text-gray-600 mb-2">Preview Foto KTP:</p>
                    <img id="ktp-preview"
                        src="{{ $user->ktp ? asset('storage/' . $user->ktp) : 'https://via.placeholder.com/150' }}"
                        class="w-40 rounded-lg border" alt="Foto KTP">
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end">
                {{-- kembali --}}
                <a href="{{ route('user.home') }}"
                    class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 mr-3">Kembali</a>
                {{-- simpan perubahan --}}
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Preview Script -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('ktp-preview').src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
