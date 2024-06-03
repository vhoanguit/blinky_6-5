@extends('pages.khachhang.register_format')
@section('content')
<section>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">

                <!--nhập otp-->
                <form action="{{URL::to('/verify_otp')}}" class="col-md-5 col-sm-6 p-3" method="POST">
                    {{ csrf_field() }}
                    <div class="VerifyOTP-form">
                        <input type="hidden" name="email" value="{{ session('email') }}">

                        <!-- Phần hiển thị thông báo lỗi -->
                        @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        @if(session()->has('ok'))
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                        <script>
                            swal({
                                title: "Vui lòng kiểm tra email để xác thực mã OTP!",
                                icon: "success",
                                // button: "Blinkiyyy!",
                            });
                            // Tự động tắt sau 3 giây
                            setTimeout(function() {
                                swal.close();
                            }, 3000);
                        </script>
                        @endif

                        <h1 class="regist_title text-center  h3 py-3 font-weight-bold ">Nhập mã OTP để đặt lại mật khẩu</h1>
                        <div class="form-group p-0 m-0">
                            <input type="text" id="otp" name="otp" class="form-control " placeholder="Vui lòng nhập đúng mã OTP"><br><br>
                            @error('recover_email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="submit" value="Xác thực OTP" class="btn-primary btn btn-block btn-more recover_password" name="btn-reg">
                        <a class="btn btn-primary btn-block btn-register mt-3" href="{{URL::to('forgot-password')}}">Quay lại</a>


                </form>
            </div>
        </div>

    </div>
</section>
@endsection