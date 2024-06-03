<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <link rel="stylesheet" href="{{asset('public/frontend/css/order_management.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <!-- HEADER -->
    @include('Header')

    <!-- SECTION -->

    <div class="container_Information">
        @include('layout.user_profile_menubar')

        <div class="input_infor_Customer" id="personal_info">
            @yield('content')
        </div>






    </div>
    <script type="text/javascript" src="{{asset('public/frontend/js/personal_infor.js') }}"></script>
</body>

</html>