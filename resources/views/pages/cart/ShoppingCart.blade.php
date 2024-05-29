
<link href="{{ asset('public/frontend/css/StyleShoppingCart.css') }}" rel="stylesheet">

    @extends('copy_layout')
    @section('cart')
    <!------------------ cart ------------------------->
    <div class="basket">
        <div class="basket_container">
            <div class="cart">
                <div class="cart_container">
                    <div class="shopping-cart-title">Giỏ hàng của bạn</div>
                    <div class="list">
                        
                        <div class="item">
                            <input type="checkbox" class="checkbox">
                            <div class = "img_product">
                                <a href="#">
                                  
                                    <img src="https://img.lazcdn.com/g/p/28fef8c7e4d69c27250e4fc8b6e6764b.png_960x960q80.png_.webp"
                                        alt="sp">
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="name">
                                    <a href="#">
                                        <div class="product-name">Vòng tay đá phong thủy đá thách anh vàng phù
                                            hợp mệnh xinh
                                            xắn thời trang</div>
                                    </a>
                                </div>
                                <div class="product-decribe">(Màu: <input type="hidden" class="color">Trắng,
                                    Kích cỡ:<input type="hidden" class="size" value="17"> 17 )
                                </div>
                                <div class="product-price">
                                    <input type="hidden" class="price" value="300000">
                                    <p class="price_text">300.000đ</p>
                                    <div class="number-input">
                                        <input type="button" value="-" class="decrease_button">
                                        <input type="number" id="item_quantity" class="quantity_values" name="quantity"
                                            value="1" aria-label="Product quantity" size="4" min="1"
                                            step="1" inputmode="numeric" autocomplete="off">
                                        <input type="button" value="+" class="increase_button">
                                    </div>
                                    <p class="total">300.000đ</p>
                                </div>
                                <p class="remove"><i class="fa-solid fa-trash"></i> Xóa</p>
                            </div>
                        </div>
                       
                        <div class="item">
                            <input type="checkbox" class="checkbox">
                            <div class = "img_product">
                                <a href="#">
                                  
                                    <img src="https://img.lazcdn.com/g/p/28fef8c7e4d69c27250e4fc8b6e6764b.png_960x960q80.png_.webp"
                                        alt="sp">
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="name">
                                    <a href="#">
                                        <div class="product-name">Vòng tay đá phong thủy đá thách anh vàng phù
                                            hợp mệnh xinh
                                            xắn thời tran</div>
                                    </a>
                                </div>
                                <div class="product-decribe">(Màu: <input type="hidden" class="color">Trắng,
                                    Kích cỡ:<input type="hidden" class="size" value="17"> 17 )
                                </div>
                                <div class="product-price">
                                    <input type="hidden" class="price" value="400000">
                                    <p class="price_text">400.000đ</p>
                                    <div class="number-input">
                                        <input type="button" value="-" class="decrease_button">
                                        <input type="number" id="item_quantity" class="quantity_values" name="quantity"
                                            value="1" aria-label="Product quantity" size="4" min="1"
                                            step="1" inputmode="numeric" autocomplete="off">
                                        <input type="button" value="+" class="increase_button">
                                    </div>
                                    <p class="total">400.000đ</p>
                                </div>
                                <p class="remove"><i class="fa-solid fa-trash"></i> Xóa</p>
                            </div>
                        </div>
                       
                        <div class="item">
                            <input type="checkbox" class="checkbox">
                            <div class = "img_product">
                                <a href="#">
                                   
                                    <img src="https://img.lazcdn.com/g/p/28fef8c7e4d69c27250e4fc8b6e6764b.png_960x960q80.png_.webp"
                                        alt="sp">
                                </a>
                            </div>
                            <div class="item-info">
                                <div class="name">
                                    <a href="#">
                                        <div class="product-name">Vòng tay đá phong thủy đá thách anh vàng phù
                                            hợp mệnh xinh
                                            xắn thời tra</div>
                                    </a>
                                </div>
                                <div class="product-decribe">(Màu: <input type="hidden" class="color">Trắng,
                                    Kích cỡ:<input type="hidden" class="size" value="17"> 17 )
                                </div>
                                <div class="product-price">
                                    <input type="hidden" class="price" value="300000">
                                    <p class="price_text">300.000đ</p>
                                    <div class="number-input">
                                        <input type="button" value="-" class="decrease_button">
                                        <input type="number" id="item_quantity" class="quantity_values"
                                            name="quantity" value="1" aria-label="Product quantity"
                                            size="4" min="1" step="1" inputmode="numeric"
                                            autocomplete="off">
                                        <input type="button" value="+" class="increase_button">
                                    </div>
                                    <p class="total">300.000đ</p>
                                </div>
                                <p class="remove"><i class="fa-solid fa-trash"></i> Xóa</p>
                            </div>
                        </div>
                       
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
                        <span>Tổng tiền</span>
                        <span class="all_total">0đ</span>
                    </div>
                    <div class="discount_container">
                        <input type="Input" name="discount" placeholder="Mã giảm giá...">
                        <button class="apply_discount">
                            <span class="discount_icon"><span
                                    class="streamline--discount-percent-coupon"></span></span>
                            <b>Áp dụng</b>
                        </button>
                    </div>
               
                    <div class="pay">
                        <button class="pay_button">Thanh toán</button>
                    </div>
                    <div class="continue">
                        <a href="{{URL::to('/san-pham')}}"><i class="fas fa-angle-double-left"></i> Tiếp tục mua hàng</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/frontend/js/ScriptShoppingCard.js') }}"></script>
@endsection
