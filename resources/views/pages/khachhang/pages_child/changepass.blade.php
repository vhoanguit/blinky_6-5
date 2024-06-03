@extends('pages.khachhang.changepass_format')

@section('content')
<div class="wrap_input">
    <div class="private_infor">
        <h2 class="inf_title">ĐỔI MẬT KHẨU</h2>
    </div>
    <!-- Các thành phần nhập thông tin  -->
    <form action="{{URL::to('/change_pass')}}" method="POST">
        @csrf
        <div class="card_body">
            <div class="form-group">
                <label for="OldPass" class="form-label">Mật khẩu cũ
                    <span class="error">*</span>
                </label>
                <input type="password" class="form-control" id="OldPass" name="OldPass" required>
                @error('OldPass')
                <small class="help-block text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="NewPass" class="form-label">Mật khẩu mới
                    <span class="error">*</span>
                </label>
                <input type="password" class="form-control" id="NewPass" name="NewPass" required>
                @error('NewPass')
                <small class="help-block text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="ConfirmPass" class="form-label">Xác nhận lại mật khẩu
                    <span class="error">*</span>
                </label>
                <input type="password" class="form-control" id="ConfirmPass" name="ConfirmPass" required>
                @error('ConfirmPass')
                <small class="help-block text-danger">{{$message}}</small>
                @enderror
            </div>


            <!-- nút cập nhật và quay lại -->

            <div class="Update-btn">
                <button type="submit" class="btn btn-changePass">Đặt lại mật khẩu</button>
            </div>
        </div>
    </form>
</div>

@endsection