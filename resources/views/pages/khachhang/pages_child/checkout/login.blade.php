@extends('pages.khachhang.login_format')
@section('content')
<section>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">
                <!-- Đăng nhập -->
                <form action="{{URL::to('/login-customer')}}" class="col-md-5 col-sm-12 " method="POST">
                    {{ csrf_field() }}
                    @if(Session::has('success'))
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Đổi mật khẩu thành công!",
                            text: "Mời bạn đăng nhập lại!",
                            icon: "success",
                            button: "Blinkiyyy!",
                        });
                    </script>
                    @endif
                    @if(Session::has('Reset Successfully'))
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    <script>
                        swal({
                            title: "Cập nhật khẩu thành công!",
                            text: "Mời bạn đăng nhập lại!",
                            icon: "success",
                            button: "Blinkiyyy!",
                        });
                    </script>
                    @endif
                    <div class="login-form">
                        <h1 class="regist_title text-center text-uppercase h3 py-3 font-weight-bold">Đăng nhập</h1>
                        <div class="form-group">
                            <label for="email-login">Email</label>
                            <input type="text" name="email_account" id="email-login" class="form-control" placeholder="example@example.com " required>
                        </div>
                        <div class="form-group">
                            <label for="pass-login">Mật khẩu</label>
                            <input type="password" name="password_account" id="pass-login" class="form-control" placeholder="*********" required>
                        </div>
                        <!-- Hiển thị thông báo nếu người dùng nhập sai tài khoản mật khẩu -->
                        <?php
                        $message = session('message');
                        if ($message) {
                            echo '<p class= "text-alert">' . $message . '</p>';
                            session()->forget('message'); // xóa session message sau khi sử dụng
                        }
                        ?>
                        <div class="d-flex justify-content-center ">
                            <a class="forgot-pass" href="{{ URL::to('/forgot-password') }}">Quên mật khẩu</a>
                        </div>
                        <!-- <span>
                            <input type="checkbox" class="checkbox" name="remember">Ghi nhớ đăng nhập
                        </span> -->
                        <input type="submit" value="Đăng Nhập" class="btn-primary btn btn-block btn-more mt-3" name="btn-reg">
                        <a class="btn btn-primary btn-block btn-register mt-3" href="{{URL::to('register')}}">Đăng ký</a>

                        @if(session()->has('error_login'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session('error_login') }}
                        </div>
                        @endif
                    </div>
                </form>

            </div>
        </div>

    </div>
</section>
@endsection