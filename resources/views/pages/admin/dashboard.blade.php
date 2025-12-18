@extends('layouts.admin.app')

@section('content')
    <!-- start main content -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header fade-up">

                <h3 class="page-title">
                    <span class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-home"></i>
                    </span> Dashboard
                </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <span></span>Overview <i
                                class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row">
                <div class="col-md-4 stretch-card grid-margin fade-up fade-delay-1">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Anggaran Tersalurkan<i
                                    class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">
                                Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
                            </h2>

                            <h6 class="card-text">
                                @if ($persenAnggaran >= 0)
                                    Meningkat {{ $persenAnggaran }}% dari bulan lalu
                                @else
                                    Menurun {{ abs($persenAnggaran) }}% dari bulan lalu
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin fade-up fade-delay-2">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Jumlah Pendaftar Baru <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">{{ $pendaftarBaru }}</h2>

                            <h6 class="card-text">
                                @if ($persenPendaftar >= 0)
                                    Meningkat {{ $persenPendaftar }}%
                                @else
                                    Menurun {{ abs($persenPendaftar) }}%
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin fade-up fade-delay-3">

                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Penerima Aktif Saat Ini <i
                                    class="mdi mdi-diamond mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">{{ $penerimaAktif }}</h2>

                            <h6 class="card-text">
                                @if ($persenPenerima >= 0)
                                    Naik {{ $persenPenerima }}%
                                @else
                                    Turun {{ abs($persenPenerima) }}%
                                @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card fade-up fade-delay-2">

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-3">
                                <h4 class="card-title mb-1">
                                    Statistik Bantuan Sosial
                                </h4>
                                <div id="visit-sale-chart-legend"
                                    class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                            </div>
                            <canvas id="visit-sale-chart" class="mt-4"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card fade-up fade-delay-3">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status Penyaluran Bantuan</h4>
                            <div class="doughnutjs-wrapper d-flex justify-content-center">
                                <canvas id="traffic-chart"></canvas>
                            </div>
                            <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin fade-up fade-delay-4">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Status Permohonan Bantuan Terakhir</h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Pendaftar </th>
                                            <th> Program </th>
                                            <th> Status </th>
                                            <th> Update </th>
                                            <th> ID </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tbody>
                                        @foreach ($permohonanTerakhir as $i => $item)
                                            <tr>
                                                {{-- FOTO PROFIL (STATIC) + NAMA (DINAMIS) --}}
                                                <td>
                                                    <img src="{{ asset('assets-admin/images/faces/face' . (($i % 4) + 1) . '.jpg') }}"
                                                        class="me-2" alt="image">
                                                    {{ $item->warga->nama ?? '-' }}
                                                </td>

                                                {{-- PROGRAM --}}
                                                <td>
                                                    {{ $item->program->nama_program ?? '-' }}
                                                </td>

                                                {{-- STATUS --}}
                                                <td>
                                                    @php
                                                        $status = strtoupper($item->status_seleksi ?? 'ON HOLD');
                                                    @endphp

                                                    @if ($status == 'DITERIMA' || $status == 'DONE')
                                                        <label class="badge badge-gradient-success">DONE</label>
                                                    @elseif ($status == 'PROSES' || $status == 'PROGRESS')
                                                        <label class="badge badge-gradient-warning">PROGRESS</label>
                                                    @elseif ($status == 'DITOLAK' || $status == 'REJECTED')
                                                        <label class="badge badge-gradient-danger">REJECTED</label>
                                                    @else
                                                        <label class="badge badge-gradient-info">ON HOLD</label>
                                                    @endif
                                                </td>

                                                {{-- TAHUN --}}
                                                <td>{{ $item->created_at->year }}</td>

                                                {{-- ID --}}
                                                <td>{{ $item->pendaftar_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.statusPenyaluran = {
                disalurkan: {{ $disalurkan }},
                dalamProses: {{ $dalamProses }},
                belumDisalurkan: {{ $belumDisalurkan }},
            };
        </script>

        <script>
            window.grafikPendaftar = @json($grafikPendaftar);
            window.grafikPenerima = @json($grafikPenerima);
            window.grafikRiwayat = @json($grafikRiwayat);

            console.log('Pendaftar:', window.grafikPendaftar);
            console.log('Penerima:', window.grafikPenerima);
            console.log('Riwayat:', window.grafikRiwayat);
        </script>


        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const reveals = document.querySelectorAll(".reveal");

                const observer = new IntersectionObserver(
                    (entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                entry.target.classList.add("active");
                                observer.unobserve(entry.target); 
                            }
                        });
                    }, {
                        threshold: 0.15
                    }
                );

                reveals.forEach(el => observer.observe(el));
            });
        </script>

        {{-- end main content --}}
    @endsection
