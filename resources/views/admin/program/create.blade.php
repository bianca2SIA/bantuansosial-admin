<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Program | BINA DESA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        /* === SIDEBAR BARU === */
        .sidebar {
            background: #ffffff;
            color: #4b5563;
            min-height: 100vh;
            width: 260px;
            position: fixed;
            left: 0;
            top: 0;
            padding: 2rem 1rem;
            display: flex;
            flex-direction: column;
            border-right: 1px solid #e5e7eb;
        }

        .sidebar h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #7e22ce;
            /* Ungu khas BINA DESA */
            margin-bottom: 2rem;
            text-align: left;
            letter-spacing: 0.5px;
        }

        .sidebar-profile {
            display: flex;
            align-items: center;
            margin-bottom: 2rem;
            padding: 0.5rem 0.75rem;
        }

        .sidebar-profile img {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .sidebar-profile div {
            display: flex;
            flex-direction: column;
        }

        .sidebar-profile .name {
            font-weight: 600;
            color: #1f2937;
        }

        .sidebar-profile .role {
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            color: #374151;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            gap: 10px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #f3e8ff;
            color: #7e22ce;
        }

        .sidebar-icon {
            color: #a855f7;
            font-size: 1.2rem;
        }

        .main-content {
            margin-left: 260px;
            padding: 2rem;
            background-color: #f9fafb;
            min-height: 100vh;
        }

        .gradient-btn {
            background: linear-gradient(90deg, #8b5cf6, #6366f1);
            transition: all 0.3s ease;
        }

        .gradient-btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>BINA DESA</h2>

        <div class="sidebar-profile">
            <img src="https://i.pravatar.cc/100?img=12" alt="Profile">
            <div>
                <span class="name">Bianca Bahi</span>
                <span class="role">Admin</span>
            </div>
        </div>

        <a href="#" class="active"><span class="sidebar-icon">🏠</span> Dashboard</a>
        <a href="#"><span class="sidebar-icon">🧾</span> Program Bantuan</a>
        <a href="#"><span class="sidebar-icon">🧍‍♂️</span> Pendaftar Bantuan</a>
        <a href="#"><span class="sidebar-icon">📋</span> Verifikasi Lapangan</a>
        <a href="#"><span class="sidebar-icon">📊</span> Penerima Bantuan</a>
        <a href="#"><span class="sidebar-icon">📅</span> Riwayat Penyaluran</a>
        <a href="#"><span class="sidebar-icon">🔒</span> User Pages</a>
        <a href="#"><span class="sidebar-icon">📘</span> Documentation</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-2xl p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-semibold text-gray-700">Tambah Program</h2>
                <a href="#"
                    class="px-4 py-2 bg-purple-100 text-purple-700 font-medium rounded-xl hover:bg-purple-200 transition">
                    ← Kembali
                </a>
            </div>

            <p class="text-gray-500 mb-8">
                Form ini digunakan untuk menambahkan data program baru.
            </p>

            <form action="{{ route('program.store') }}" method="POST" enctype="multipart/form-data"
                class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                <!-- Nama Program -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Nama Program</label>
                    <input type="text" name="nama_program" placeholder="Masukkan nama program"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" />
                </div>

                <!-- Kode Program -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Kode Program</label>
                    <input type="text" name="kode_program" placeholder="Masukkan kode program"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" />
                </div>

                <!-- Tahun -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Tahun</label>
                    <input type="number" name="tahun" placeholder="Contoh: 2025"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" />
                </div>

                <!-- Anggaran -->
                <div>
                    <label class="block text-gray-700 font-medium mb-2">Anggaran (Rp)</label>
                    <input type="number" name="anggaran" placeholder="Masukkan anggaran"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none" />
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                    <textarea rows="4" name="deskripsi" placeholder="Tuliskan deskripsi program"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-purple-400 focus:outline-none"></textarea>
                </div>

                <!-- Gambar Program -->
                <div class="md:col-span-2">
                    <label class="block text-gray-700 font-medium mb-2">Gambar Program</label>
                    <input name="gambar_program" type="file"
                        class="w-full text-gray-700 bg-white border border-gray-300 rounded-xl px-4 py-2 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-purple-100 file:text-purple-700 hover:file:bg-purple-200" />
                </div>

                <!-- Tombol -->
                <div class="md:col-span-2 flex justify-end gap-4 mt-4">
                    <button type="button"
                        class="px-6 py-2 bg-gray-200 text-gray-700 rounded-xl font-medium hover:bg-gray-300 transition">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2 text-white rounded-xl font-medium shadow gradient-btn">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
