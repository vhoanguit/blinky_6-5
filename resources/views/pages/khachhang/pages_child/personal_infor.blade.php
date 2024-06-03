@extends('pages.khachhang.personal_infor_format')

@section('content')

<!-- THÔNG TIN CÁ NHÂN -->
<div class="private_infor">
    <h2 class="inf_title">THÔNG TIN CÁ NHÂN</h2>
</div>
<!-- Các thành phần nhập thông tin  -->
<form action="{{ URL::to('/upload-avatar/'.$customer->customer_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if(session()->has('success-update-avatar'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Cập nhật ảnh đại diện thành công!",
            icon: "success",
            // button: "Blinkiyyy!",
        });
        // Tự động tắt sau 3 giây
        setTimeout(function() {
            swal.close();
        }, 2000);
    </script>
    @endif
    @if(session()->has('error-update-avatar'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Ảnh đại diện không tồn tại !",
            icon: "error",
            // button: "Blinkiyyy!",
        });
        // Tự động tắt sau 3 giây
        setTimeout(function() {
            swal.close();
        }, 2000);
    </script>
    @endif
    <div class="card_avatar">
        <input type="file" name="avatar">
        <button type="submit">Tải lên ảnh đại diện</button>
    </div>
</form>
<form action="{{ URL::to('/update-customer/'.$customer->customer_id) }}" method="POST">
    {{ csrf_field() }}
    <!-- Phần hiển thị thông cập nhật thành công -->
    @if(session()->has('success-update'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Cập nhật thông tin thành công!",
            icon: "success",
            // button: "Blinkiyyy!",
        });
        // Tự động tắt sau 3 giây
        setTimeout(function() {
            swal.close();
        }, 2000);
    </script>
    @endif
    @if(Session::has('Login Successfully'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Đăng nhập thành công!",
            text: "Chúc bạn có trải nghiệm tuyệt vời tại Blinkiy!",
            icon: "success",
            button: "Blinkiyyy!",
        });
        setTimeout(function() {
            swal.close();
        }, 3000);
    </script>
    @endif
    @if(Session::has('error_change_email'))
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal({
            title: "Bạn không thể cập nhật email!",
            icon: "error",
            button: "OK",
        });
        setTimeout(function() {
            swal.close();
        }, 3000);
    </script>
    @endif
    <div class="card_body">
        <div class="form-group">
            <label for="user-name" class="form-label">Tên đăng nhập:</label>
            <input type="text" class="form-control" id="user-name" name="user_name" value="{{ $customer->customer_name }}" placeholder="Blinkiy...">
        </div>
        <div class="form-group">
            <label for="date" class="form-label">Ngày sinh: </label>
            <input type="date" class="form-control" id="form-label" name="user_date" value="{{ $customer->customer_date }}">
        </div>
        <div class="form-group">
            <label for="user-tel" class="form-label">Điện thoại: </label>
            <input type="text" class="form-control" id="user-tel" name="user_tel" value="{{ $customer->customer_phone }}" placeholder="09xxxxxxxxx">
        </div>
        <div class="form-group">
            <label for="user-email" class="form-label">Email: </label>
            <input type="email" class="form-control" id="user-email" name="user_email" value="{{ $customer->customer_email }}" readonly placeholder="email@domain.com....">
        </div>
        <div class="form-group">
            <label for="user_city" class="form-label">Tỉnh/thành phố:</label>
            <select id="user_city" name="user_city" class="form-control" style="width: 104%; font-size:18px ; height:fit-content" required>
                <option value="">Chọn tỉnh thành</option>
                @foreach($provinces as $key => $province)
                <!-- Nếu tên tỉnh trong bảng tinh giống vói tỉnh khách hàng chọn thì sẽ hiển thị tỉnh thành đó ra -->
                <option value="{{ $province->province_id }}" @if($province->province_name == $customer->customer_city) selected @endif>{{ $province->province_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user_district" class="form-label">Quận/Huyện:</label>
            <select id="user_district" name="user_district" class="form-control" style="width: 104%; font-size:18px ; height:fit-content" required>
                @foreach($districts as $district)
                <option value="{{ $district->district_id }}" @if($district->district_name == $customer->customer_district) selected @endif>{{ $district->district_name }}</option>
                @endforeach
            </select>
        </div>


        <!-- Nút cập nhật và quay lại -->
        <div class="Update-btn">
            <button type="submit" class="btn btn-update">Cập nhật</button>
            <a href="" class="btn btn-back">Quay lại</a>
        </div>
    </div>
</form>

<script>
    // var i =document.getElementById('user-city').value;
    // console.log(i);
    $(document).ready(function() {
        $('#user_city').on('change', function() {
            var cityId = $(this).val();
            console.log('Selected city: ' + cityId); // Log selected province
            console.log(cityId);
            if (cityId) {
                $.ajax({
                    type: "POST",
                    url: '{{url("/get-districts")}}',
                    // Đổi phương thức từ GET sang POST
                    data: {
                        cityId: cityId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log('AJAX success response:', response); // Log success response
                        $('#user_district').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error); // Log error details
                    }
                });
            } else {
                $('#user_district').html('<option value="">Chọn quận, huyện</option>');
            }
        });
    });
</script>


@endsection