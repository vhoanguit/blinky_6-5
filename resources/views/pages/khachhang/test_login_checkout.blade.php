<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test bấm thanh toán thì phải đăng ký</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="col-sm-6">
        <div class="total_area">
            <ul>
                <li>Tổng</li>
                <li>Phí vận chuyển</li>
                <li>Thành tiền</li>
            </ul>
            <a class="btn btn-btn-default update "href="{{URL::to('login-checkout')}}">Thanh toán</a>
        </div>
    </div>
    
</body>
</html>