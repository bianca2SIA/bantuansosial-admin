@extends('layouts.admin.app')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">

            {{-- JUDUL HALAMAN --}}
            <div class="page-header">
                <h3 class="page-title">
                    Profil Pengembang
                </h3>
            </div>

            {{-- CARD PROFIL --}}
            <div class="row justify-content-center">
                <div class="col-12 col-xl-16 grid-margin stretch-card">
                    <div class="card border-0 shadow-sm mx-auto"
                        style="background: #ffffff; max-width: 1100px; min-height: 410px;">
                        <div class="card-body d-flex align-items-center justify-content-center p-5">

                            <div class="row align-items-center">
                                {{-- FOTO (KIRI) --}}
                                <div class="col-md-4 text-center mb-4 mb-md-0">
                                    <img src="{{ asset('assets-admin/images/foto-saya.JPG') }}" alt="Foto Profil"
                                        class="rounded-circle" width="180" style="border:5px solid #e5d9ff">
                                </div>

                                {{-- IDENTITAS (KANAN) --}}
                                <div class="col-md-8">

                                    <h3 class="fw-bold mb-1 text-dark">
                                        BIANCA BAHI
                                    </h3>

                                    <p class="text-muted mb-3">
                                        Mahasiswi D4 Sistem Informasi
                                    </p>

                                    <div class="mb-3">
                                        <p class="mb-1"><strong>NIM</strong> : 2457301026</p>
                                        <p class="mb-1"><strong>Program Studi</strong> : D4 Sistem Informasi</p>
                                    </div>

                                    <p class="text-muted mb-4">
                                        Mahasiswi D4 Sistem Informasi yang sedang mengembangkan
                                        aplikasi bantuan sosial berbasis web menggunakan framework Laravel
                                        sebagai bagian dari tugas pengembangan sistem informasi.
                                    </p>

                                    {{-- SOSIAL MEDIA --}}
                                    <div class="d-flex gap-3">
                                        <a href="https://www.linkedin.com/in/bianca-bahi-9aaa6a393" target="_blank"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="mdi mdi-linkedin"></i>
                                        </a>

                                        <a href="https://github.com/bianca2SIA" target="_blank"
                                            class="btn btn-outline-dark btn-sm">
                                            <i class="mdi mdi-github"></i>
                                        </a>
                                        <a href="mailto:biancabahi02@gmail.com" class="btn btn-outline-info btn-sm">
                                            <i class="mdi mdi-email"></i>
                                        </a>
                                        <a href="https://instagram.com/biiancaa.aa" target="_blank"
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="mdi mdi-instagram"></i>
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    @endsection
