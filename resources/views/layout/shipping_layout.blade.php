<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Shipping')</title>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style_van_chuyen.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/StyleHeaderOnly.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/css/StyleFooterOnly.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/style_hoa_don.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style_thanh_toan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/style_bo_sung.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="{{ asset('public/frontend/js/file_upload_handling.js') }}"></script>
</head>
<body>
    {{-- <header>
        @include('includes.navbar')
    </header> --}}
    @include('Header')
    
    @yield('content')

    {{-- <footer>
        @include('includes.footer')
    </footer> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @stack('scripts')
</body>
</html>