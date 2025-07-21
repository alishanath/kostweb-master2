@extends('auth.user.index')
@section('title', 'User Profile')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">


            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden transition-shadow hover:shadow-lg">
                <!-- Card Header -->
                <div class="bg-gradient-to-r from-green-600 to-green-500 px-6 py-4">
                    <h2 class="text-xl font-semibold text-white">Profil Pengguna</h2>
                </div>

                <!-- Card Body -->
                <div class="p-6">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-4">
                                <!-- Name Field -->
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('name') border-red-500 @enderror"
                                        value="{{ old('name', auth()->user()->name) }}" required>
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone Field -->
                                <div>
                                    <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp
                                        Aktif</label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">+62</span>
                                        <input type="text" id="no_hp" name="no_hp"
                                            class="w-full px-4 py-2 border rounded-r-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('no_hp') border-red-500 @enderror"
                                            value="{{ old('no_hp', ltrim(auth()->user()->no_hp, '+62')) }}" required>
                                    </div>
                                    @error('no_hp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email Field -->
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('email') border-red-500 @enderror"
                                        value="{{ old('email', auth()->user()->email) }}" required>
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-4">
                                <!-- Birth Date Field -->
                                <div>
                                    <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                        Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('tanggal_lahir') border-red-500 @enderror"
                                        value="{{ old('tanggal_lahir', auth()->user()->tanggal_lahir) }}" required>
                                    @error('tanggal_lahir')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Address Field -->
                                <div>
                                    <label for="alamat"
                                        class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition @error('alamat') border-red-500 @enderror"
                                        required>{{ old('alamat', auth()->user()->alamat) }}</textarea>
                                    @error('alamat')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- KTP Upload Section -->
                        <div class="mt-8 pt-6 border-t">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Dokumen KTP</h3>

                            <!-- Current KTP Preview -->
                            @if (auth()->user()->ktp_path)
                                <div class="mb-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">KTP Saat Ini</label>
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                        <div class="border-2 border-gray-200 rounded-lg p-2 bg-gray-50">
                                            @if (Str::endsWith(auth()->user()->ktp_path, ['.jpg', '.jpeg', '.png', '.gif']))
                                                <img src="{{ asset('storage/' . auth()->user()->ktp_path) }}"
                                                    alt="KTP Preview" class="h-32 object-contain mx-auto"
                                                    id="current-ktp-image">
                                            @else
                                                <div class="flex flex-col items-center p-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                    </svg>
                                                    <span
                                                        class="mt-2 text-sm font-medium text-gray-700">{{ basename(auth()->user()->ktp_path) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-600 mb-2">Dokumen identitas Anda sudah terunggah.
                                            </p>
                                            <a href="{{ asset('storage/' . auth()->user()->ktp_path) }}" target="_blank"
                                                class="inline-flex items-center text-sm text-green-600 hover:text-green-800 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                Lihat Dokumen
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- KTP Upload Field -->
                            <div>
                                <label for="ktp-upload" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ auth()->user()->ktp_path ? 'Unggah KTP Baru' : 'Unggah KTP (wajib)' }}
                                </label>

                                <div class="mt-1 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                                    <label for="ktp-upload" class="cursor-pointer">
                                        <span
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            Pilih File
                                        </span>
                                        <input id="ktp-upload" name="ktp" type="file" class="sr-only"
                                            accept="image/*,.pdf">
                                    </label>
                                    <span id="file-name" class="text-sm text-gray-500">
                                        {{ auth()->user()->ktp_path ? 'Biarkan kosong jika tidak ingin mengubah' : 'Belum ada file dipilih' }}
                                    </span>
                                </div>
                                @error('ktp')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Format: JPG, PNG, PDF (Maksimal 2MB)</p>
                            </div>

                            <!-- Preview Area -->
                            <div id="ktp-preview" class="mt-6 {{ auth()->user()->ktp_path ? 'hidden' : '' }}">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Pratinjau KTP</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center bg-gray-50">
                                    <img id="preview-image" src="#" alt="Preview KTP"
                                        class="max-h-48 mx-auto hidden">
                                    <div id="pdf-preview" class="hidden flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <span id="pdf-name" class="mt-2 text-sm font-medium text-gray-700"></span>
                                    </div>
                                    <p id="no-preview" class="text-sm text-gray-500">Pratinjau akan muncul di sini</p>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="mt-8 flex flex-col-reverse sm:flex-row justify-between gap-4">
                            <a href="{{ url()->previous() }}"
                                class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                Kembali
                            </a>
                            <button type="submit"
                                class="inline-flex justify-center items-center px-6 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // KTP upload preview functionality
            const ktpUpload = document.getElementById('ktp-upload');
            const fileName = document.getElementById('file-name');
            const previewContainer = document.getElementById('ktp-preview');
            const previewImage = document.getElementById('preview-image');
            const pdfPreview = document.getElementById('pdf-preview');
            const pdfName = document.getElementById('pdf-name');
            const noPreview = document.getElementById('no-preview');

            ktpUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file) {
                    fileName.textContent = file.name;
                    previewContainer.classList.remove('hidden');
                    noPreview.classList.add('hidden');

                    // Check if file is PDF
                    if (file.type === 'application/pdf') {
                        previewImage.classList.add('hidden');
                        pdfPreview.classList.remove('hidden');
                        pdfName.textContent = file.name;
                    } else {
                        // It's an image
                        pdfPreview.classList.add('hidden');
                        previewImage.classList.remove('hidden');

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                } else {
                    fileName.textContent =
                        '{{ auth()->user()->ktp_path ? 'Biarkan kosong jika tidak ingin mengubah' : 'Belum ada file dipilih' }}';
                    previewContainer.classList.add('hidden');
                    previewImage.classList.add('hidden');
                    pdfPreview.classList.add('hidden');
                    noPreview.classList.remove('hidden');
                }
            });
        });
    </script>
@endpush
