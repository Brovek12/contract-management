@extends('layouts.app-auth')

@section('title', 'Login')

@section('content')

    <div class="text-center mb-8">

        {{-- Logo --}}
        <img src="{{ asset('assets/media/logos/bukaka1.png') }}"
             alt="Bukaka"
             style="height: 60px; margin-bottom: 20px;">

        {{-- Title --}}
        <h1 style="font-size: 24px; font-weight: 700; color: #181c32; margin: 0 0 8px;">
            Masuk
        </h1>

        {{-- Subtitle --}}
        <p style="color: #a1a5b7; font-size: 14px; margin: 0;">
            Silahkan masukkan username dan password anda.
        </p>
    </div>

    <form action="{{ route('login') }}" method="POST">
        @csrf

        {{-- Error Alert --}}
        @if (session('ERROR'))
            <div class="alert alert-danger mb-5" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('ERROR') }}
            </div>
        @endif

        {{-- Username --}}
        <div class="mb-4">
            <input type="text"
                   name="username"
                   id="username"
                   class="form-control form-control-solid"
                   placeholder="Username"
                   value="{{ old('username') }}"
                   autocomplete="username"
                   required
                   style="padding: 14px 18px; font-size: 14px;">

            @error('username')
                <span class="text-danger small d-block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-6 position-relative">
            <input type="password"
                   name="password"
                   id="password"
                   class="form-control form-control-solid"
                   placeholder="Password"
                   autocomplete="current-password"
                   required
                   style="padding: 14px 18px; font-size: 14px; padding-right: 48px;">

            <button type="button"
                    onclick="togglePassword(this)"
                    style="position: absolute; top: 50%; right: 12px; transform: translateY(-50%); background: none; border: none; color: #a1a5b7; cursor: pointer;">
                <i class="bi bi-eye fs-5"></i>
            </button>

            @error('password')
                <span class="text-danger small d-block mt-1">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="btn btn-primary w-100"
                style="padding: 14px; font-size: 15px; font-weight: 600; border-radius: 10px;">
            Login
        </button>

        {{-- Forgot Password --}}
        <div class="text-center mt-5">
            <a href="#" style="color: #009ef7; font-size: 14px; text-decoration: none;">
                Lupa Password?
            </a>
        </div>

    </form>

@endsection

@section('script')
    <script>
        function togglePassword(button) {
            const input = button.parentElement.querySelector('input');
            const icon  = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-fill');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-fill');
                icon.classList.add('bi-eye');
            }
        }
    </script>
@endsection