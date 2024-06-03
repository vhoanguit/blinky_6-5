<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <link rel="stylesheet" href="{{asset('public/frontend/css/change_pass.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <!-- HEADER -->
    @include('Header')
    <!-- SECTION -->
    <section class="container_Information">
        @include('layout.user_profile_menubar')
        <!-- THAY ĐỔI MẬT KHẨU -->
        <div class="input_infor_Customer" id="personal_info">
            @yield('content')
        </div>



    </section>
    <script type="text/javascript" src="{{asset('public/frontend/js/personal_infor.js') }}"></script>
</body>

</html>