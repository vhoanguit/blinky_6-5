<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mục ưa thích</title>
    <link rel="stylesheet" href="{{ asset('public/frontend/css/favor.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @include('Header')
    <div class="favor">
        <div class="favor_container">
            <div class="header">Mục ưa thích</div>
            @if (Session::has('customer_id'))
                @if (isset($favorites) && count($favorites) > 0)
                    <ul class="cart_items">
                        @foreach ($favorites as $favorite)
                            <li data-product-id="{{ $favorite->product_id }}">
                                <div class="product">
                                    <div class="img_product">
                                        <a href="{{ url('/chi-tiet-san-pham/' . $favorite->product_id) }}">
                                            <img src="{{ URL::to('public/uploads/product/' . $favorite->product_image) }}"
                                                alt="{{ $favorite->product_name }}">
                                        </a>
                                    </div>
                                    <div class="info">
                                        <p class="product_name">
                                            <a
                                                href="{{ url('/chi-tiet-san-pham/' . $favorite->product_id) }}">{{ $favorite->product_name }}</a>
                                        </p>
                                        <p class="product_price">{{ $favorite->product_price }}đ</p>
                                    </div>
                                    <div class="choose_type">
                                        <p class="type_size">
                                            <select id="input_size_{{ $favorite->product_id }}" name="size_id">
                                                <option value="" selected disabled hidden>- Chọn kích cỡ -
                                                </option>
                                                @foreach ($sizes[$favorite->product_id] as $size)
                                                    <option value="{{ $size->size_id }}"
                                                        data-max-quantity="{{ $size->SL }}">
                                                        {{ $size->size_value }}</option>
                                                @endforeach
                                            </select>
                                        </p>
                                        <div class="quantity_selector">
                                            <p class="number-input">
                                                <input type="button" value="-" class="decrease_button">
                                                <input type="number" id="item_quantity_{{ $favorite->product_id }}"
                                                    class="quantity_values" name="quantity" value="1"
                                                    aria-label="Product quantity" size="4" min="1"
                                                    step="1" inputmode="numeric" autocomplete="off">
                                                <input type="button" value="+" class="increase_button">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="add_produce">
                                        <p class="icon">
                                            <i class="fa-solid fa-cart-plus"
                                                onclick="addToCart({{ $favorite->product_id }}, '{{ $favorite->product_name }}', '{{ $favorite->product_image }}', {{ $favorite->product_price }}, $('#item_quantity_{{ $favorite->product_id }}').val())"></i>
                                        </p>
                                        <input type="button" value="Thêm vào giỏ hàng" class="add"
                                            onclick="addToCart({{ $favorite->product_id }}, '{{ $favorite->product_name }}', '{{ $favorite->product_image }}', {{ $favorite->product_price }}, $('#item_quantity_{{ $favorite->product_id }}').val())">
                                    </div>
                                    <p class="remove"><i class="fa-solid fa-trash"></i> Xóa</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="login_request">Không có sản phẩm yêu thích nào.</p>
                @endif
            @else
                <p class="login_request">Bạn cần <a href="{{ route('login') }}">đăng nhập</a> để xem mục ưa thích của
                    mình.</p>
            @endif
        </div>
    </div>

    <script type="text/javascript">
        function addToCart(productId, productName, productImage, productPrice, productQuantity) {
            var sizeId = $('#input_size_' + productId).val();
            if (!sizeId) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Chưa chọn kích cỡ',
                    text: 'Vui lòng chọn kích cỡ.'
                });
                return;
            }
            
            $.ajax({
                url: "{{ url('/add-to-cart') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_product_id: productId,
                    cart_product_name: productName,
                    cart_product_image: productImage,
                    cart_product_price: productPrice,
                    cart_product_quantity: productQuantity,
                    cart_product_size: sizeId
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: 'Thêm vào giỏ hàng thành công!',
                            showCancelButton: true,
                            confirmButtonText: 'Chuyển tới giỏ hàng',
                            cancelButtonText: 'Ở lại trang'
                        }).then((result) => {
                            Update_Number_Of_Cart();
                            if (result.isConfirmed) {
                                window.location.href = '{{ url('/gio-hang') }}';
                            }
                            
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: 'Số lượng bạn chọn vượt quá số lượng tồn kho!'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Có lỗi xảy ra, vui lòng thử lại.'
                    });
                }
            });

        }
        function Update_Number_Of_Cart()
        {
            $.ajax({
                type: 'POST',
                url: "{{ url('/your-cart') }}",
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Cập nhật số lượng sản phẩm hiển thị trên ô giỏ hàng thành công');
                    if (parseInt(response.number) < 99) 
                    {
                        $('#cart-shopping-quantity').text(response.number);
                    } else {
                        $('#cart-shopping-quantity').text('99+');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('AJAX call failed: ' + textStatus + ', ' +
                        errorThrown);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Tìm tất cả các nút "Xóa"
            const removeButtons = document.querySelectorAll('.remove');

            removeButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Tìm phần tử li chứa nút "Xóa" hiện tại
                    const li = button.closest('li');
                    if (li) {
                        const productId = li.getAttribute('data-product-id');
                        // Gửi yêu cầu AJAX để xóa sản phẩm yêu thích
                        $.ajax({
                            url: "{{ url('/remove-favorite') }}",
                            method: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                product_id: productId
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Xóa phần tử li khỏi DOM
                                    li.remove();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Thành công',
                                        text: 'Sản phẩm yêu thích đã được xóa!'
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Lỗi',
                                        text: 'Có lỗi xảy ra, vui lòng thử lại.'
                                    });
                                }
                            },
                            error: function() {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Lỗi',
                                    text: 'Có lỗi xảy ra, vui lòng thử lại.'
                                });
                            }
                        });
                    }
                });
            });

            document.querySelectorAll('.decrease_button').forEach(button => {
                button.addEventListener('click', function() {
                    const quantityInput = this.nextElementSibling;
                    let quantity = parseInt(quantityInput.value);
                    if (quantity > 1) {
                        quantity--;
                        quantityInput.value = quantity;
                        quantityInput.dispatchEvent(new Event('input'));
                    }
                });
            });

            document.querySelectorAll('.increase_button').forEach(button => {
                button.addEventListener('click', function() {
                    const quantityInput = this.previousElementSibling;
                    let quantity = parseInt(quantityInput.value);
                    quantity++;
                    quantityInput.value = quantity;
                    quantityInput.dispatchEvent(new Event('input'));
                });
            });

            document.querySelectorAll('.quantity_values').forEach(input => {
                input.addEventListener('input', function() {
                    let quantity = parseInt(this.value);
                    if (isNaN(quantity) || quantity < 1) {
                        this.value = 1;
                    }
                });
            });
        });
    </script>
    </div>
    @include('Footer')
    {{-- <script type="text/javascript" src="{{ asset('public/frontend/js/script_favor.js') }}"></script> --}}
</body>

</html>