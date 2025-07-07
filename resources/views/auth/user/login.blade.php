@extends('auth.user.main')
@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="form-box">
            <h2 class="text-center">Login</h2>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('auth.user.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" required>
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3 text">
                    <a href="">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <p>Tidak Punya Akun? <a href="{{ route('auth.user.register') }}">Register here</a></p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(e) {
                const email = $('#email').val().trim();
                const password = $('#password').val().trim();

                if (!email || !password) {
                    e.preventDefault();
                    alert('Please fill in all fields.');
                    return false;
                }

                // Validasi email format sederhana
                if (!/^\S+@\S+\.\S+$/.test(email)) {
                    e.preventDefault();
                    alert('Please enter a valid email address.');
                    return false;
                }

                return true;
            });
        });
    </script>
@endsection
