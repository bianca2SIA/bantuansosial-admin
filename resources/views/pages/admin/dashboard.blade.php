@extends('layouts.admin.app')

@section('content')
    <!-- start main content -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
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
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-danger card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Anggaran Tersalurkan<i
                                    class="mdi mdi-chart-line mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">Rp 3.425.000.000</h2>
                            <h6 class="card-text">Meningkat 12% dari bulan lalu</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-info card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Jumlah Pendaftar Baru <i
                                    class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">1.284</h2>
                            <h6 class="card-text">Meningkat 8%</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 stretch-card grid-margin">
                    <div class="card bg-gradient-success card-img-holder text-white">
                        <div class="card-body">
                            <img src="assets-admin/images/dashboard/circle.svg" class="card-img-absolute"
                                alt="circle-image" />
                            <h4 class="font-weight-normal mb-3">Penerima Aktif Saat Ini <i
                                    class="mdi mdi-diamond mdi-24px float-end"></i>
                            </h4>
                            <h2 class="mb-5">9.578</h2>
                            <h6 class="card-text">Naik 3%</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-7 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="clearfix">
                                <h4 class="card-title float-start">Visit And Sales Statistics</h4>
                                <div id="visit-sale-chart-legend"
                                    class="rounded-legend legend-horizontal legend-top-right float-end"></div>
                            </div>
                            <canvas id="visit-sale-chart" class="mt-4"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Traffic Sources</h4>
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
                <div class="col-12 grid-margin">
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
                                        <tr>
                                            <td>
                                                <img src="assets-admin/images/faces/face1.jpg" class="me-2"
                                                    alt="image"> Wan Rania Salma
                                            </td>
                                            <td> Bantuan Usaha Mikro Desa </td>
                                            <td>
                                                <label class="badge badge-gradient-success">DONE</label>
                                            </td>
                                            <td> 2025 </td>
                                            <td> 13 </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets-admin/images/faces/face2.jpg" class="me-2"
                                                    alt="image"> Naaila Raqila
                                            </td>
                                            <td> Pembangunan Jalan Desa </td>
                                            <td>
                                                <label class="badge badge-gradient-warning">PROGRESS</label>
                                            </td>
                                            <td> 2025 </td>
                                            <td> 14 </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets-admin/images/faces/face3.jpg" class="me-2"
                                                    alt="image"> Haya Nur Rizky
                                            </td>
                                            <td> Beasiswa Anak Petani </td>
                                            <td>
                                                <label class="badge badge-gradient-info">ON HOLD</label>
                                            </td>
                                            <td> 2024 </td>
                                            <td> 15 </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets-admin/images/faces/face4.jpg" class="me-2"
                                                    alt="image"> Geta Dwi Artika
                                            </td>
                                            <td> Renovasi Rumah Layak Huni </td>
                                            <td>
                                                <label class="badge badge-gradient-danger">REJECTED</label>
                                            </td>
                                            <td> 2025 </td>
                                            <td> 16 </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="assets-admin/images/faces/face2.jpg" class="me-2"
                                                    alt="image"> Jihan Zahra
                                            </td>
                                            <td> Program Air Bersih </td>
                                            <td>
                                                <label class="badge badge-gradient-warning">PROGRESS</label>
                                            </td>
                                            <td> 2025 </td>
                                            <td> 17 </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- end main content --}}
    @endsection
