@extends('pages.khachhang.register_format')
@section('content')
<section>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">

                <!--QUÊN MẬT KHẨU-->
                <form action="{{URL::to('/reset-password')}}" class="col-md-6 col-sm-6" method="POST">
                    {{ csrf_field() }}
                    <div class="forgotpass-form">
                        <!-- Phần hiển thị thông báo lỗi -->
                        <!-- @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif -->

                        <h1 class="regist_title text-center text-uppercase h3 py-3 font-weight-bold ">THIẾT LẬP MẬT KHẨU MỚI</h1>
                        <div class="form-group">
                            <label for="NewPass" class="form-label">Mật khẩu mới
                                <span class="error text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="NewPass" name="NewPass" required>
                            @error('NewPass')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="ConfirmNewPass" class="form-label">Xác nhận khẩu mới
                                <span class="error text-danger">*</span>
                            </label>
                            <input type="password" class="form-control" id="ConfirmNewPass" name="ConfirmNewPass" required>
                            @error('ConfirmNewPass')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="submit" value="Cập nhật mật khẩu mới" class="btn-primary btn btn-block btn-more recover_password" name="btn-reg">
                        <a class="btn btn-primary btn-block btn-register mt-3" href="{{URL::to('verify_otp')}}">Quay lại</a>

                        </>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection