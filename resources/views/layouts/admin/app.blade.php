<!DOCTYPE html>
<html lang="id">
<style>
    a#profileDropdown.nav-link.dropdown-toggle::after {
        display: none !important;
        content: none !important;
    }
</style>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SiBansos | BantuanSosial </title>


    {{-- start css --}}
    @include('layouts.admin.css')
    {{-- end css --}}
</head>
{{-- ✅ Floating WhatsApp Button --}}
<a href="https://wa.me/6282289807582?text=Halo%20BinaDesa!" class="whatsapp-float" target="_blank" rel="noopener">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" width="28" height="28" fill="white">
        <path
            d="M380.9 97.1C339 55.1 283.3 32 224.8 32 107.8 32 16 123.9 16 240.9c0 42.5 11.1 83.9 32.1 120L0 480l122.3-47.8c34.7 19 73.9 29 114.5 29h.1c116.9 0 208.8-91.8 208.8-208.9 0-58.5-23.1-114.1-64.8-155.2zM224.8 438.6h-.1c-35.9 0-71.1-9.7-101.7-28.1l-7.3-4.3-72.6 28.3 27.7-74.8-4.7-7.6c-19.7-31.7-30.1-68.4-30.1-106.1 0-108.3 88.2-196.5 196.6-196.5 52.5 0 101.8 20.5 138.8 57.6 37 37 57.4 86.3 57.4 138.7 0 108.4-88.2 196.8-196.7 196.8zM316.3 304.6c-5.3-2.6-31.3-15.4-36.1-17.1-4.8-1.8-8.3-2.6-11.8 2.6s-13.5 17.1-16.6 20.7c-3 3.5-6.1 3.9-11.4 1.3-5.3-2.6-22.4-8.3-42.6-26.6-15.7-14-26.3-31.2-29.3-36.5s-.3-8.1 2.3-10.7c2.4-2.4 5.3-6.1 7.9-9.2 2.6-3 3.5-5.2 5.3-8.7 1.8-3.5.9-6.5-.4-9.2s-11.8-28.5-16.2-39.1c-4.3-10.4-8.7-9-11.8-9.2-3-.2-6.5-.2-10-.2s-9.2 1.3-14 6.5c-4.8 5.3-18.3 17.8-18.3 43.4 0 25.6 18.7 50.3 21.3 53.8 2.6 3.5 36.9 56.3 89.5 78.9 12.5 5.4 22.3 8.7 29.9 11.1 12.6 4 24.1 3.5 33.1 2.1 10.1-1.5 31.3-12.8 35.7-25.1 4.4-12.3 4.4-22.8 3-25.1-1.5-2.2-4.8-3.6-10.1-6.1z" />
    </svg>
</a>

<style>
    /* 🌿 Floating WhatsApp Button */
    .whatsapp-float {
        position: fixed;
        width: 50px;
        height: 50px;
        bottom: 95px;
        right: 25px;
        background-color: #25D366;
        color: #fff;
        border-radius: 50%;
        text-align: center;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
        z-index: 999;
    }

    .whatsapp-float:hover {
        transform: scale(1.1);
    }
</style>
{{-- ✅ end floating button --}}

<body>
    <div class="container-scroller">

        {{-- start header --}}
        @include('layouts.admin.header')
        {{-- end header --}}

        <div class="container-fluid page-body-wrapper">

            {{-- start sidebar --}}
            @include('layouts.admin.sidebar')
            {{-- end sidebar --}}

            {{-- start main content --}}
            @yield('content')
            {{-- end main content --}}

            {{-- start footer --}}
            @include('layouts.admin.footer')
            {{-- end footer --}}

        </div>
    </div>
    {{-- start js --}}
    @include('layouts.admin.js')
    {{-- end js --}}

</body>
