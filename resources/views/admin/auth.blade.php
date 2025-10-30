<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ isset($success) ? 'Login Berhasil - BINA DESA' : 'Login - BINA DESA' }}</title>

    {{-- 🔗 Load CSS dari template admin --}}
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}" />

    {{-- 🎨 CSS tambahan halaman login dan success --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;

    /* Tambahan baru 👇 */
    background: url('{{ asset('assets-admin/images/bansos.jpg') }}') no-repeat center center fixed;
    background-size: cover;

    /* Lapisan transparan di atas gambar */
    position: relative;
    overflow: hidden;
}

        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
        }

        .card-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.15);
            width: 380px;
            padding: 40px 35px;
            text-align: center;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .app-title {
            font-size: 28px;
            font-weight: 700;
            color: #7b2cbf;
            margin-bottom: 8px;
        }
        .app-description {
    font-size: 11.5px;        /* 🔹 Mengecilkan teks */
    color: #000000;           /* Tetap warna ungu */
    margin-bottom: 18px;      /* Kurangi jarak bawah sedikit */
    line-height: 1.3;         /* Jarak antar baris lebih rapat */
    opacity: 0.9;             /* Sedikit lembut supaya tidak terlalu mencolok */
    animation: fadeIn 1s ease;
}
        h2 {
            font-size: 18px;
            font-weight: 600;
            color: #9b5de5;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 500;
            color: #5a189a;
            margin-bottom: 6px;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            border-radius: 10px;
            border: 1px solid #d1b3ff;
            background: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #7b2cbf;
            box-shadow: 0 0 8px rgba(123, 44, 191, 0.3);
            outline: none;
        }

        button,
        .btn {
            width: 100%;
            background: linear-gradient(to right, #9b5de5, #7b2cbf);
            color: white;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        button:hover,
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(123, 44, 191, 0.3);
        }

        .error-box {
            color: #b00020;
            background: #fdecea;
            border: 1px solid #f5b7b1;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: left;
            font-size: 13px;
        }

        .footer {
            margin-top: 15px;
            font-size: 13px;
            color: #7b2cbf;
        }

        .icon {
            font-size: 60px;
            color: #7b2cbf;
            margin-bottom: 20px;
        }

        /* Hover efek lembut untuk card */
        .card-container:hover {
            box-shadow: 0 10px 45px rgba(123, 44, 191, 0.25);
        }
    </style>
</head>

<body>
    {{-- 🔐 Jika login berhasil --}}
    @if (isset($success))
        <div class="card-container">
            <div class="icon">✅</div>
            <div class="app-title">BINA DESA</div>
            <h2>Login Berhasil!</h2>
            <p>Selamat datang kembali, <b>{{ Auth::user()->name ?? 'Admin' }}</b> 🎉</p>
            <a href="{{ url('/dashboard') }}" class="btn">Masuk ke Dashboard</a>
            <div class="footer">© 2025 BINA DESA — Bantuan Sosial Digital</div>
        </div>
    @else
        {{-- 🪄 Form login --}}
      <div class="card-container">
    <img src="{{ asset('assets-admin/images/logo-bina-desa.png') }}"
         alt="Logo Bina Desa"
         class="login-logo">

    <div class="app-title">BINA DESA</div>
    <p class="app-description">
        Sistem Manajemen Bantuan Sosial Digital<br>
        untuk mendukung transparansi dan akurasi penyaluran bantuan di desa.
    </p>




            @if ($errors->any())
                <div class="error-box">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('auth.login') }}">
                @csrf
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email') }}" placeholder="Masukkan email">

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password">

                <button type="submit">Masuk</button>
            </form>

            <div class="footer">© 2025 BINA DESA — Bantuan Sosial Digital</div>
        </div>
    @endif
</body>

</html>
