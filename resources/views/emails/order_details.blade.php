<!DOCTYPE html>
<html>
<head>
    <title>Hóa Đơn</title>
</head>
<body>
    <div class="invoice">
        <h1>Hóa Đơn</h1>
        @if ($order)
            <div class="invoice_section">
                <h2>Thông tin khách hàng</h2>
                <p>Họ tên: {{ $order->TenKH ?? '' }}</p>
                <p>Email: {{ $order->Email ?? '' }}</p>
                <p>SĐT: {{ $order->SDT ?? '' }}</p>
                <p>Địa chỉ: {{ $order->DiaChi ?? '' }}</p>
            </div>
            <div class="invoice_section">
                <h2>Thông tin đơn hàng</h2>
                <p>Mã đơn hàng: {{ $order->MaHDVL ?? '' }}</p>
                <p>Ngày đặt hàng: {{ $order->NgDH ?? '' }}</p>
                <p>Mô tả: {{ $order->Note ?? '' }}</p>
                <p>Hình ảnh: <span id="img_des">{{ $order->File ?? '' }}</span></p>
            </div>
            <div class="invoice_section">
                <h2>Phương thức thanh toán</h2>
                @switch($order->PTTT)
                    @case(1)
                        <p>Thanh toán bằng MoMo</p>
                        @break
                    @case(2)
                        <p>Thanh toán bằng ngân hàng</p>
                        @break
                    @case(3)
                        <p>Thanh toán khi nhận hàng</p>
                        @break
                @endswitch
            </div>
            <div class="invoice_section">
                <h2>Chi tiết sản phẩm</h2>
                <div class="item">
                    <img src="{{ asset('pics/Rectangle 85.png') }}" alt="Vòng tay hạt cườm xinh xắn (Mẫu 1)">
                    <p class="item_name">Vòng tay hạt cườm xinh xắn (Mẫu 1)</p>
                    <p class="item_color">Màu: Trắng</p>
                    <p class="item_size">Kích cỡ: 17</p>
                    <p class="item_quantity">1</p>
                    <p class="item_total">18,000 ₫</p>
                </div>
            </div>
            <div class="invoice_section">
                <p>Tổng tiền: {{ $order->TriGia ?? 0 }}</p>
                <p>Giảm giá: 0</p>
                <p>Phí giao hàng: 0</p>
                <p>Thành tiền: {{ $order->TriGia ?? 0 }}</p>
            </div>
        @else
            <p>Không tìm thấy hóa đơn.</p>
        @endif
    </div>
</body>
</html>