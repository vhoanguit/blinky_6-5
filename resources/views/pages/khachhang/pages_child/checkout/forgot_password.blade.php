@extends('pages.khachhang.register_format')
@section('content')
<section>
    <div class="wrapper">
        <div class="container">
            <div class="row justify-content-around">

                <!--QUÊN MẬT KHẨU-->
                <form action="{{URL::to('/forgot-password')}}" class="col-md-6 col-sm-6" method="POST">
                    {{ csrf_field() }}
                    <div class="forgotpass-form">
                        <!-- Phần hiển thị thông báo lỗi -->
                        @if (session('error'))
                        <div class="alert alert-danger">
                        <p style="margin: auto; text-align: center">{{ session('error') }}</p>
                        </div>
                        @endif

                        <h1 class="regist_title text-center text-uppercase h3 py-3 font-weight-bold ">ĐẶT LẠI MẬT KHẨU</h1>
                        <P style="text-align:center; font-family: 'Roboto', sans-serif;--font-serif: 'Yeseva One', cursive">Chúng tôi sẽ gửi cho bạn một email để kích hoạt việc đặt lại mật khẩu.</P>
                        <div class="form-group">
                            <input type="email" name="recover_email" id="recover_email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" placeholder="Email" required>
                            @error('recover_email')
                            <small class="help-block text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <input type="submit" value="Lấy lại mật khẩu" class="btn-primary btn btn-block btn-more recover_password" name="btn-reg">
                        <a class="btn btn-primary btn-block btn-register mt-3" href="{{URL::to('login')}}">Quay lại</a>

                        </>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection