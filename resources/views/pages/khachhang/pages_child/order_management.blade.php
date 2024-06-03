@extends('pages.khachhang.order_management_format')

@section('content')

<!-- PHẦN QUẢN LÝ ĐƠN HÀNG -->

<div class="wrap_input">
    <div class="private_infor">
        <h1 class="inf_title">ĐƠN HÀNG CỦA BẠN</h1>
    </div>
    <!-- Các thành của đơn hàng  -->
    <div class="table_inf">
        <table class="table table-cart" id="my-orders-table">
            <thead class="thead-default">
                <tr>
                    <th class="donhang">Đơn hàng</th>
                    <th class="ngay">Ngày</th>
                    <th class="diachi">Địa chỉ</th>
                    <th class="giatri">Giá trị đơn hàng</th>
                    <th class="ttthanhtoan">TT Thanh Toán</th>
                    <th class="ttvanchuyen">TT Vận Chuyển</th>
                    <th class="chitiet">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>1</p>
                    </td>
                    <td>12/5</td>
                    <td>78/1 Nguyễn Bỉnh Khiêm</td>
                    <td>500000</td>
                    <td>Chưa thanh toán</td>
                    <td>Chưa vận chuyển </td>
                    <td>
                    <button type="submit" class="btn btn-update">Chi tiết</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>


@endsection