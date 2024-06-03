@extends('pages.khachhang.register_format')
@section('content')
<section>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">

                <!-- Đăng ký -->
                <form action="{{URL::to('/add-customer')}}" class="col-md-5 col-sm-6" method="POST">
                    {{ csrf_field() }}
                    <div class="register-form">
                        <!-- Phần hiển thị thông báo lỗi -->
                        <!-- @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif -->
                        @if(Session::has('register success'))
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            swal({
                                title: "Đăng ký thành công!",
                                icon: "success",
                                timer: 3000, // Thời gian hiển thị thông báo (3 giây)
                                buttons: false // Ẩn nút Đóng
                            }).then(function() {
                                // Sau khi hiển thị thông báo xong, chuyển hướng đến trang thông tin khách hàng
                                window.location.href = "{{ url('/pages.personal_infor') }}";
                            });
                        </script>
                        @endif

                        <h1 class="regist_title text-center text-uppercase h3 py-3 font-weight-bold">Đăng ký</h1>
                        <div class="form-group">
                            <label for="customer_name">Họ tên</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                            @error('customer_name')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_phone">Điện thoại</label>
                            <input type="text" name="customer_phone" id="customer_phone" class="form-control" required>
                            @error('customer_phone')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_email">Email</label>
                            <input type="email" name="customer_email" id="customer_email" class="form-control" required>
                            @error('customer_email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="customer_pass">Mật khẩu</label>
                            <input type="password" name="customer_pass" id="customer_pass" class="form-control" required>
                            @error('customer_pass')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="submit" value="Đăng ký" class="btn-primary btn btn-block btn-more btn-regist" name="btn-reg">
                        <a class="btn btn-primary btn-block btn-register mt-3" href="{{URL::to('login')}}">Đăng nhập</a>

                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection