@extends('layout.shipping_layout')
@section('content')
    <div class="process">
        <div class="current"> Vận chuyển&nbsp; </div> >
        <div> &nbsp;Thông tin bổ sung&nbsp; </div> >
        <div> &nbsp;Thanh toán&nbsp; </div>
    </div>
    <div class="details">
        <p class="header_details">VẬN CHUYỂN</p>
        <p class="instruction">Hãy điền địa chỉ của bạn hoặc <a href="#log_in">Đăng nhập</a></p>
        <form id="input_form" method="POST" action="{{ route('shipping.store') }}">
    @csrf
    <table class="input_container">
        <tr>
            <td colspan="2">
                <label for="name">Họ tên:</label>
                <input type="text" id="name" name="name" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
            </td>
            <td>
                <label for="phone_num">Điện thoại:</label>
                <input type="tel" id="phone_num" name="phone_num" required>
            </td>
        </tr>
        <tr>
            <td>
                <select id="province" name="province" required>
                    <option value="">Chọn tỉnh thành</option>
                    @foreach($provinces as $province)
                        <option value="{{ $province->province_id }}">{{ $province->province_name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select id="district" name="district" required>
                    <option value="">Chọn quận, huyện</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="address">Số nhà, đường, phường, xã:</label>
                <input type="text" id="address" name="address" required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label for="apartment">Số phòng, tòa:</label>
                <input type="text" id="apartment" name="apartment">
            </td>
        </tr>
        <tr>
            <td class="submit_button" align="center" colspan="2">
                <input type="Submit" class="submit" Value="Tiếp tục" name="Submit">
            </td>
        </tr>
    </table>
</form>

    </div>
    @push('scripts')
    <script>
        $(document).ready(function() {
            $('#province').change(function() {
                var province = $(this).val();
                console.log('Selected province: ' + province);  // Log selected province
                if (province) {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('shipping.fetch_district') }}',
                        data: {
                            province: province,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('AJAX success response:', response);  // Log success response
                            $('#district').html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error('AJAX Error: ' + status + error);  // Log error details
                        }
                    });
                } else {
                    $('#district').html('<option value="">Chọn quận, huyện</option>');
                }
            });
        });
    </script>
    @endpush
@endsection