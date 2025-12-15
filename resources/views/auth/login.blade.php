@extends('layouts.auth.app')

@section('content')

    <div class="card">

        <div class="auth-logo">
            <img src="{{ asset('assets-admin/images/logo.png') }}" alt="SiBansos Logo">
        </div>

        <div class="title">SIBANSOS</div>

        <div class="desc">
            Sistem Manajemen Bantuan Sosial Digital<br>
            untuk mendukung transparansi penyaluran bantuan desa.
        </div>

        @if ($errors->any())
            <div class="error-box">
                <ul style="margin-left: 15px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <label>Email</label>
            <input type="text" name="email" placeholder="Masukkan email" value="{{ old('email') }}">

            <label>Password</label>
            <input type="password" name="password" placeholder="Masukkan password">

            <button type="submit">Masuk</button>
        </form>

        <div class="footer">© 2025 SIBANSOS — Bantuan Sosial Digital</div>

    </div>

@endsection
