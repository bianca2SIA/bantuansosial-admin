@extends('layouts.auth.app')

@section('content')

<div class="card login-card">

    {{-- LOGO --}}
    <div class="auth-logo animate-logo">
        <img src="{{ asset('assets-admin/images/logo.png') }}" alt="SiBansos Logo">
    </div>

    {{-- TITLE --}}
    <h2 class="title animate-1">SIBANSOS</h2>

    {{-- DESCRIPTION --}}
    <p class="desc animate-2">
        Sistem Manajemen Bantuan Sosial Digital<br>
        untuk mendukung transparansi penyaluran bantuan desa.
    </p>

    {{-- ERROR --}}
    @if ($errors->any())
        <div class="error-box animate-3">
            <ul style="margin-left:15px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('auth.login') }}" method="POST">
        @csrf

        <div class="animate-3">
            <label>Email</label>
            <input
                type="text"
                name="email"
                placeholder="Masukkan email"
                value="{{ old('email') }}"
            >
        </div>

        <div class="animate-4">
            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Masukkan password"
            >
        </div>

        <button type="submit" class="animate-5">
            Masuk
        </button>
    </form>

    {{-- FOOTER --}}
    <div class="footer animate-5">
        © 2025 SIBANSOS — Bantuan Sosial Digital
    </div>

</div>

@endsection
