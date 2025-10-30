<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Berhasil - KITAPEDULI</title>

    {{-- 🔗 Load CSS dari template admin --}}
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-admin/css/custom.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets-admin/images/favicon.png') }}" />

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

        /* ✨ Efek blur lembut di background */
        body::before {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            z-index: 0;
        }

        /* ✨ Container utama */
        .success-container {
            position: relative;
            z-index: 2;
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 24px;
            box-shadow: 0 12px 40px rgba(123, 44, 191, 0.2);
            width: 400px;
            padding: 50px 40px;
            text-align: center;
            animation: fadeIn 0.7s ease-in-out;
        }

        /* ✨ Animasi masuk lembut */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ✅ Ikon sukses */
        .icon {
            font-size: 70px;
            color: #7b2cbf;
            margin-bottom: 25px;
            animation: bounceIn 0.7s ease-in-out;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            60% {
                transform: scale(1.2);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        /* 🎉 Teks */
        h2 {
            font-size: 22px;
            font-weight: 700;
            color: #7b2cbf;
            margin-bottom: 12px;
        }

        p {
            font-size: 15px;
            color: #333;
            margin-bottom: 35px;
        }

        /* 💜 Tombol Dashboard */
        .btn {
            display: inline-block;
            background: linear-gradient(to right, #9b5de5, #7b2cbf);
            color: white;
            text-decoration: none;
            padding: 14px 25px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 280px;
            font-size: 15px;
            letter-spacing: 0.3px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(123, 44, 191, 0.3);
        }

        /* ✨ Hover lembut untuk card */
        .success-container:hover {
            box-shadow: 0 14px 50px rgba(123, 44, 191, 0.25);
        }
    </style>

</head>

<body>
    <div class="success-container">
        <div class="icon">✅</div>
        <h2>Login Berhasil!</h2>
        <p>Selamat datang kembali, <b>{{ Auth::user()->name ?? 'Admin' }}</b> 🎉</p>
        <a href="{{ url('/dashboard') }}" class="btn">Masuk ke Dashboard</a>
    </div>
</body>

</html>
