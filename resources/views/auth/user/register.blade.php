@extends('auth.user.main')
@section('title', 'Register')
@section('content')

    <div class="container">
        <div class="form-box">
            <h2 class="text-center">Register</h2>
            <p class="text-center"><a href="{{ route('auth.user.login') }}">Sudah Registrasi? Klik Disini Untuk Login</a></p>
            <form method="POST" action="{{ route('auth.user.register') }}">
                @csrf
                <div class="mb-3">
                    <label>Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>No. WhatsApp Aktif</label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" required>
                    @error('no_hp')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}"
                        required>
                    @error('tanggal_lahir')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Kata Sandi (minimal 6 karakter)</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        // Add your custom JavaScript here
        // Example: Show an alert on form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            // You can add custom validation or actions here
            alert('Form submitted!');
        });
        // Example: Show an alert on button click
        document.querySelector('.btn-primary').addEventListener('click', function() {
            alert('Button clicked!');
        });
        // Example: Show an alert on input change
        document.querySelectorAll('input, textarea').forEach(function(input) {
            input.addEventListener('change', function() {
                alert('Input changed!');
            });
        });
        // Example: Show an alert on form reset

        document.querySelector('form').addEventListener('reset', function() {
            alert('Form reset!');
        });
    </script>
@endsection
