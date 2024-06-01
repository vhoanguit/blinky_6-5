<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('public/frontend/css/StyleShoppingCart.css') }}" rel="stylesheet">
    <title>Giỏ hàng | Blinkiy</title>
</head>

<body>
    @include('Header')

    <!------------------ cart ------------------------->
    <div class="basket">
        <div class="basket_container">
            <div class="cart">
                <div class="cart_container">
                    <div class="shopping-cart-title">Giỏ hàng của bạn</div>
                    <div id="list" class="list">

                    </div>
                </div>
            </div>
            
            <div class="info_container">
                <div class="info">
                    <p class="info_header">Thông tin đơn hàng</p>
                    <hr>
                    <div class="order_items">
                    </div>
                    <div class="total_container">
                        <span class="total_title">Tổng tiền</span>
                        <span class="all_total"></span>
                    </div>
                    <div class="discount_container">
                        <input type="Input" name="discount" placeholder="Mã giảm giá...">
                        <button class="apply_discount">
                            <span class="discount_icon"><span class="streamline--discount-percent-coupon"></span></span>
                            <b>Áp dụng</b>
                        </button>
                    </div>

                    <div class="pay">
                        <button class="pay_button">Thanh toán</button>
                    </div>
                    <div class="continue">
                        <a href="#"><i class="fas fa-angle-double-left"></i> Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('public/frontend/js/CreateCart.js') }}"></script>
    <script src="{{ asset('public/frontend/js/ScriptShoppingCart.js') }}"></script>

</body>

</html>
