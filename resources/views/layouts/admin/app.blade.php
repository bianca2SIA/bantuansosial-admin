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
    <title>Data Program Bantuan | BINA DESA</title>

    {{-- start css --}}
    @include('layouts.admin.css')
    {{-- end css --}}
</head>

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
    </div>
    {{-- start js --}}
    @include('layouts.admin.js')
    {{-- end js --}}

</body>

</html>
