@extends('admin_layout')
@section('admin_content')
<link rel="stylesheet" href="{{ asset('public/backend/css/order_manager.css') }}">
<section class="panel">
    <header class="panel-heading">
        Các đơn hàng chưa được xử lý
    </header>
    <div class="panel-body">
        <table border='1' cellspacing='0'>
            <tr>
                <th class='order_STT'>STT</th>
                <th class='order_Ma'>Mã đơn hàng</th>
                <th class='order_Ten'>Tên khách hàng</th>
                <th class='order_Email'>Email</th>
                <th class='order_SDT'>Số điện thoại</th>
                <th class='order_Diachi'>Địa chỉ</th>
                <th class='order_Tongtien'>Tổng giá trị đơn hàng</th>
                <th class='order_Thoigian'>Thời gian đặt hàng</th>
                <th class='order_Trangthai'>Trạng thái</th>
                <th class='order_Hoatdong'>Hoạt động</th>
            </tr>
            <!-- order_id	customer_id	customer_name	customer_email	customer_phone	customer_address	order_total_price	order_date	order_status -->
            @foreach ($orders as $index => $orders)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $orders->order_id }}</td>
                    <td>{{ $orders->customer_name}}</td>
                    <td>{{ $orders->customer_email }}</td>
                    <td>{{ $orders->customer_phone }}</td>
                    <td>{{ $orders->customer_address }}</td>
                    <td>{{ $orders->order_total_price }}</td>
                    <td>{{ $orders->order_date }}</td>
                    <td>{{ $orders->order_status }}</td>
                    <td>
                        <a href="{{ url('/accept-order/' . $orders->order_id) }}">Chấp nhận</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</section>
@endsection