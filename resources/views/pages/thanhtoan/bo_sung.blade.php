@extends('layout.shipping_layout')

@section('content')
<div class="process">
    <div class="current"> Vận chuyển&nbsp; </div> >
    <div class="current"> &nbsp;Thông tin bổ sung&nbsp; </div> >
    <div> &nbsp;Thanh toán&nbsp; </div>
</div>
<div class="addition">
    <p class="addition_header">Thông tin bổ sung</p>
    <form class="addition_form" method="POST" action="{{ route('bo-sung.store') }}" enctype="multipart/form-data">
        @csrf
        <span id="header_1">Hãy cho chúng tôi biết yêu cầu đặc biệt của bạn về chiếc vòng nhé!</span>
        <textarea id="mo_ta" name="mo_ta" rows="10" cols="100" placeholder="Chi tiết sản phẩm"></textarea><br>
        <span id="header_2">Hình ảnh chi tiết yêu cầu của bạn</span>
        <div class="img_input">
            <label for="file_input" class="custom-file-upload">Chọn ảnh</label>
            <input type="file" id="file_input" name="file_input">
            <a href="#" id="file_link"><p id="file_name">Chưa có ảnh nào được chọn</p></a>
        </div>
        <div class="return_container">
            <span><a href="{{ route('shipping.index') }}" class="return">&lt; Quay lại</a></span>
        </div>
        <input type="Submit" class="submit" Value="Tiếp tục" name="Submit">
    </form>
</div>
<footer>
    <!-- Your footer content -->
</footer>
<script>
$(document).ready(function() {
    $('#file_input').on('change', function() {
        const fileInput = this;
        const fileNameSpan = $('#file_name');
        const fileLink = $('#file_link');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileNameSpan.text(file.name);
            fileLink.off('click').on('click', function(e) {
                e.preventDefault();
                const fileURL = URL.createObjectURL(file);
                // Mở fileDisplay.blade.php trong một cửa sổ mới
                const newWindow = window.open('{{ route("fileDisplay") }}' + `?fileURL=${fileURL}&fileType=${file.type}&fileName=${file.name}`);
            });
        } else {
            fileNameSpan.text('Chưa có ảnh nào được chọn');
            fileLink.attr('href', '#');
        }
    });
});
</script>
@endsection