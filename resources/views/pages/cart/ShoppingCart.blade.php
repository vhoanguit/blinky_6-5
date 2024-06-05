<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="{{ asset('public/frontend/css/StyleShoppingCart.css') }}" rel="stylesheet">
    <title>Giỏ hàng | Blinkiy</title>
    
</head>

<body>
    @include('Header')

    <!------------------ cart ------------------------->
    <input type="hidden" id="customer-id" value="{{ $login }}">
    <div class="basket">
        <div class="basket_container">
            <div class="cart">
                <div class="cart_container">
                    <div class="shopping-cart-title">Giỏ hàng của bạn</div>
                    <div id="list" class="list">

                        @if ($login)
                            @if($ShoppingCart->isEmpty())
                                <p class="note">Bạn chưa có sản phẩm nào trong giỏ hàng, hãy thêm vào đi nào :3</p>
                            @else
                                @foreach ($ShoppingCart as $key => $cart)
                                    <div class="item">
                                        <input type="checkbox" class="checkbox">
                                        <div class = "img_product">
                                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $cart->product_id) }}">
                                                <img class="product_img"
                                                    src="{{ URL::to('public/uploads/product/' . $cart->product_image) }}"
                                                    alt="sp">
                                            </a>
                                        </div>

                                        <div class="item-info">
                                            <div class="name">
                                                <a href="{{ URL::to('/chi-tiet-san-pham/' . $cart->product_id) }}">
                                                    <div class="product-name">{{ $cart->product_name }}</div>
                                                </a>
                                                <input type="hidden" class="product-id" value="{{ $cart->product_id }}">
                                            </div>
                                            <div class="product-decribe">(Màu: <input type="hidden"
                                                    class="color">{{ $cart->product_color }},
                                                Kích cỡ:<input type="hidden" class="size" value="{{ $cart->size_id }}">
                                                {{ $cart->size_value }} )
                                            </div>
                                            <div class="product-price">
                                                <input type="hidden" class="price" value="{{ $cart->product_price }}">
                                                <p class="price_text">{{ number_format($cart->product_price, 0, '.', '.') }}đ
                                                </p>
                                                <div class="number-input">
                                                    <input type="button" value="-" class="decrease_button"
                                                        onclick="UpdateCart(this)">
                                                    <input type="number" class="quantity_values" name="quantity"
                                                        value="{{ $cart->cart_quantity }}" aria-label="Product quantity"
                                                        size="4" min="1" step="1" inputmode="numeric"
                                                        autocomplete="off" onchange="UpdateCart(this)">
                                                    <input type="button" value="+" class="increase_button"
                                                        onclick="UpdateCart(this)">
                                                    <input type="hidden" class="inventory" value="{{ $cart->SL }}">
                                                </div>
                                                <p class="total">
                                                    {{ number_format($cart->cart_quantity * $cart->product_price, 0, '.', '.') }}đ
                                                </p>
                                            </div>
                                            <p class="remove" onclick="DeleteCart(this)"><i class="fa-solid fa-trash"></i>
                                                Xóa</p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @else
                            <script src="{{ asset('public/frontend/js/CreateCart.js') }}"></script>
                        @endif

                    </div>
                </div>
            </div>

            <div class="info_container">
                <div class="info">
                    <p class="info_header">Thông tin đơn hàng</p>
                    <hr>
                    <div class="order_items">
                    </div>
                    <hr>
                    <div class="total_container">
                        <span class="total_title">Tổng tiền</span>
                        <span class="all_total">0đ</span>
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

    {{-- $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }); --}}
    
    <script src="{{ asset('public/frontend/js/ScriptShoppingCart.js') }}"></script>
    <script>
        function DeleteCart(cart) {
            var product = cart.closest('.item');
            const proid = product.querySelector('.product-id').value;
            const prosize = product.querySelector('.size').value;
            const customer = document.getElementById('customer-id').value;
            const proquantity = product.querySelector('.quantity_values').value;

            // alert(proquantity);
            $.ajax({
                type: 'GET',
                url: '',
                data: {
                    proid: proid,
                    prosize: prosize,
                    customer: customer,
                    proquantity: proquantity,
                    action: 'delete-shopping-cart'
                },
                success: function(response) {

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX call failed: ' + textStatus + ', ' +
                        errorThrown);
                }
            });
        }

        function UpdateCart(cart) {

            var product = cart.closest('.item');
            var proid = product.querySelector('.product-id').value;
            var prosize = product.querySelector('.size').value;
            var customer = document.getElementById('customer-id').value;
            var proquantity = product.querySelector('.quantity_values').value;

            if (cart.value === '+') { proquantity = parseInt(proquantity) + 1; } 
            else if (cart.value === '-') { if (proquantity > 1) {proquantity = parseInt(proquantity) - 1;}}

            $.ajax({
                type: 'GET',
                url: '',
                data: {
                    proid: proid,
                    prosize: prosize,
                    customer: customer,
                    proquantity: proquantity,
                    action: 'update-shopping-cart'
                },
                success: function(response) {

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX call failed: ' + textStatus + ', ' +
                        errorThrown);
                }
            });
        }
    </script>
    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'delete-shopping-cart') {
        $product = $_GET['proid'];
        $size = $_GET['prosize'];
        $customer = $_GET['customer'];
        $quantity = $_GET['proquantity'];
    
        DB::table('tbl_cart')->where('product_id', $product)->where('size_id', $size)->where('customer_id', $customer)->delete();
    }
    if (isset($_GET['action']) && $_GET['action'] == 'update-shopping-cart') {
        $product = $_GET['proid'];
        $size = $_GET['prosize'];
        $customer = $_GET['customer'];
        $quantity = $_GET['proquantity'];
    
        DB::table('tbl_cart')
            ->where('product_id', $product)
            ->where('size_id', $size)
            ->where('customer_id', $customer)
            ->update(['cart_quantity' => $quantity]);
    }
    ?>
    <script>
        $(document).ready(function() {
            $('.pay_button').on('click', function(e) {
                e.preventDefault();
                saveCart();
            });
        });
    
        function saveCart() {
            let cartData = [];
            $('.item').each(function() {
                let product = {
                    product_id: $(this).find('.product-id').val(),
                    product_name: $(this).find('.product-name').text().trim(),
                    product_price: $(this).find('.price').val(),
                    product_quantity: $(this).find('.quantity_values').val(),
                    product_color: $(this).find('.color').text().trim(),
                    product_size: $(this).find('.size').val(),
                    product_size_value: $(this).find('.product-decribe').text().trim()
                };
                cartData.push(product);
            });
    
            $.ajax({
                type: 'POST',
                url: "{{ route('cart.save') }}",
                data: {
                    cart: cartData,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    } else {
                        console.error('Error:', response.error);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        }
    </script>
    <script>
        $(document).ready(function() {
            // Hàm để cập nhật dữ liệu giỏ hàng từ session vào HTML
            updateCartFromSession();
        });
        
        function updateCartFromSession() {
            // Lấy dữ liệu giỏ hàng từ session
            let sessionCart = @json(Session::get('cart', []));
            
            // Duyệt qua dữ liệu giỏ hàng từ session và cập nhật vào HTML
            sessionCart.forEach(function(item) {
                // Tìm các phần tử sản phẩm tương ứng trong HTML
                let productElement = $('.item').filter(function() {
                    return $(this).find('.product-id').val() == item.product_id &&
                           $(this).find('.size').val() == item.size_id;
                });
                // Nếu sản phẩm được tìm thấy trong HTML, cập nhật số lượng
                if (productElement.length > 0) {
                    let quantity = parseInt(item.product_quantity);
                    productElement.find('.quantity_values').val(quantity);
                    productElement.find('.total').text(formatCurrency(quantity * item.product_price));
                }
            });
        }
        
        function formatCurrency(value) {
            // Hàm định dạng số tiền sang chuỗi có dấu phân cách hàng nghìn
            return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(value);
        }
        </script>
        <script>
            $(document).ready(function() {
                $('.pay_button').on('click', function(e) {
                    e.preventDefault();
                    window.location.href = "{{ route('shipping.index') }}";
                });
            });
        </script>
                
</body>
@include('Footer')
</html>