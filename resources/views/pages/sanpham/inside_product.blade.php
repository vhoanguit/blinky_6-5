<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sản phẩm | Blinkiy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('public/frontend/css/StyleInsideProduct.css') }}" rel="stylesheet">

</head>
<body>

    @include('Header')

    @foreach ($product as $key => $pro)
        <section class="inside_product_section">
            {{-- <div class="all-inside_product"> --}}
            <input type="hidden" id="customer-id" value="{{$login}}">
            <div class="filter_from_product_page">
                <p>
                    <br>
                    <a href="{{ URL::to('/san-pham') }}"><span id="product_name">Sản phẩm</span></a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        style="color:#EF99A2" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    @foreach ($cate_of_product as $key => $cate)
                        <a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}"><span
                                id="filter_link_from_name">{{ $cate->category_name }}</span></a>
                    @endforeach

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        style="color:#EF99A2" class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    <a href="{{ URL::to('/danh-muc-san-pham/' . $pro->product_id) }}"><span
                            id="filter_link_from_name">{{ $pro->product_name }}</span></a>
                </p>
            </div>

            <div class="below_filter">
                <div class="image_container">
                    <div class="image_wrapper">
                        <button class="left_btn" style="display: block;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                            </svg>
                        </button>
                        <img id="main_image" src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}">
                        <button class="right_btn" style="display: block;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                            </svg>
                        </button>
                    </div>
                    <p>
                    <div class="extra_images">
                        @foreach ($gallery_product as $key => $image)
                            <img class="extra_image" id="extra_image1"
                                src="{{ URL::to('public/uploads/gallery/' . $image->gallery_image) }}" alt=""
                                style="object-fit: cover">
                        @endforeach
                    </div>
                    <br>
                    </p>
                </div>

                <hr>

                <div class="container">
                    <div class="product_container">

                        <h3 id="title"><b>{{ $pro->product_name }}</b></h3>
                        {{-- <br> --}}
                        <div class="price">{{ number_format($pro->product_price) . ' ' . 'VNĐ' }}</div>

                        <div class="size_container">
                            <p id="size_of_product">Kích cỡ</p>
                            {{-- <button type="button" class="size-unative">25
                            </button> --}}
                            @foreach ($size as $key => $size_pro)
                                @if ($size_pro->SL > 0)
                                    <button type="button" class="size" value="{{ $size_pro->size_id }}"
                                        onclick="selectSize(this, {{ $size_pro->size_value }}, {{ $size_pro->SL }})">{{ $size_pro->size_value }}
                                    </button>
                                @else
                                    <button type="button" class="size-unative">{{ $size_pro->size_value }}</button>
                                @endif
                            @endforeach
                        </div>

                        <hr>

                        <div class="quantity_container">
                            <p id="quantity">Số lượng</p>
                            <div id="buy_amount">
                                <button class="minus" id="minus_btn" onclick="handleMinus()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                    </svg>
                                </button>
                                <input type="text" name="amountnumber" id="amountnumber" value="1" min="1">
                                <button class="plus" id="plus_btn" onclick="handlePlus()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>

                                <div id="quantity_of_product">
                                    <?php
                                    $sum = 0;
                                    foreach ($size as $key => $proSL) {
                                        $sum += $proSL->SL;
                                    }
                                    
                                    echo "<p>$sum" . ' sản phẩm có sẵn</p>';
                                    ?>
                                    
                                </div>
                                <input type="hidden" id="total_inventory" value="{{$sum}}" >
                            </div>

                        </div>

                        <hr>
                    </div>
                    {{-- <p id="test_text">test nè</p> --}}
                    <div class="button_container">
                        <div class="addtocart_container">
                            <form method="GET">
                                {{ csrf_field() }}
                                {{-- @csrf --}}
                                <button type="button" id="add_product_to_cart" onclick="addToCart()">
                                    <!-- <span class="cart-icon">🛒</span> -->
                                    <input type="hidden" id="productid_hidden" name="productid_hidden" value="{{ $pro->product_id }}">
                                    <input type="hidden" id="productname_hidden" name="productname_hidden" value="{{ $pro->product_name }}">
                                    <input type="hidden" id="productcolor_hidden" name="productcolor_hidden" value="{{ $pro->product_color }}">
                                    <input type="hidden" id="productprice_hidden" name="productprice_hidden" value="{{ $pro->product_price }}">
                                    <input type="hidden" id="productimage_hidden" name="productimage_hidden" value="{{ $pro->product_image }}">

                                    <span class="cart-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                            <path
                                                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0
                                                                                                1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3
                                                                                                0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0
                                                                                                0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                        </svg>
                                        <span class="btn-text">Thêm vào giỏ hàng</span>
                                </button>
                            </form>
                        </div>


                        <div class="buynow_container">
                            <button id="buy_product_now" onclick="buynow()">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-lightning-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873
                                                                                                -.454L6.823 9.5H3.5a.5.5 0 0 1-.48-.641z" />
                                    </svg>

                                    <span>Mua ngay</span>
                            </button>
                            <br>
                        </div>
                    </div>

                    <div class="favorite_container">
                        <button id="favorite_product" onclick="toggleFavorite()" class="favorite_button">
                            <span>
                                <svg id="heart_svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi-heart" viewBox="0 0 16 16">
                                    <path id="heart_path"
                                        d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286
                                                                                            6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333
                                                                                            4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                            </span>
                            <span class="favorite_product_text">
                                Yêu thích
                            </span>
                        </button>
                    </div>


                </div>
            </div>


            <!-- <div class="container-title">
            <p>SẢN PHẨM MỚI NHẤT</p>
            <hr>
            </div> -->
            <div class="Product_description">
                <div class="description_heading">
                    <br>
                    <h4>MÔ TẢ SẢN PHẨM</h4>
                    <hr>
                </div>
                <br>
                <div class="restof_description">
                    <p>
                        <b>Sơ lược:&nbsp;</b>
                    </p>
                    <p class="text_content">
                        <span style="font-family: 'Arial',sans-serif;">
                            {!! $pro->product_content !!}
                        </span>
                    </p>
                    <br>
                    <p>
                        <b>Mô tả chi tiết:&nbsp;</b>
                    </p>
                    <p class="text_content">
                        <span style="font-family: 'Arial',sans-serif;">
                            {!! $pro->product_desc !!}
                        </span>
                    </p>

                </div>
                <br><br>
            </div>
            <br>
    @endforeach

    <div class="related_product">
        <section class="product-category">
            <div class="container-title">
                <p>SẢN PHẨM LIÊN QUAN</p>
                <hr>
            </div>

            <div class="card-container">
                <div class="pre-btn"><i class="fa-solid fa-angle-left"></i></div>

                <div class="carousel">
                    <div class="list-product-card">
                        @foreach ($related_product as $key => $related_pro)
                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $related_pro->product_id) }}">
                                <div class="product_card">
                                    <div class="product-image">
                                        <img class="product-img"
                                            src="{{ URL::to('public/uploads/product/' . $related_pro->product_image) }}">
                                    </div>
                                    <div class="product-content">
                                        <a class="product-name" href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">{{ $related_pro->product_name }}</a>
                                        <p>{{ number_format($related_pro->product_price) . ' ' . 'VNĐ' }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                        <div class="carousel-end"></div>
                    </div>
                </div>

                <div class="nxt-btn"><i class="fa-solid fa-angle-right"></i></div>
            </div>

        </section>
    </div>

    <footer>

    </footer>

    {{-- </section> --}}
    <script type="text/javascript" src="{{ asset('public/frontend/js/InsightProduct.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/frontend/js/ScriptCardSlider.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!--Này thêm để làm cái thêm giỏ hàng với mua ngay nè-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('public/frontend/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            
            $('#add_product_to_cart').click(function() 
            {
                const sizeSelected = document.querySelector('.size.selected');
                if (sizeSelected) 
                {
                    var customer = $('#customer-id').val();
                    var proid = $('#productid_hidden').val();
                    var prosize= sizeSelected.value;
                    var proquantity=$('#amountnumber').val();

                    if (proid){

                        $.ajax({
                            type: 'GET',
                            url: '',
                            data: {
                                proid: proid,
                                prosize: prosize,
                                customer: customer,
                                proquantity: proquantity,
                                action: 'add-to-shopping-cart'
                            },
                            success: function(response) {
                                // $('#test_text').html(response);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.log('AJAX call failed: ' + textStatus + ', ' +
                                    errorThrown);
                            }
                        });
                    }
                }
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'add-to-shopping-cart') 
    {
        // $conn = new mysqli('localhost', 'root', '', 'blinkiy');
        // if ($conn->connect_error) {
        //     die('Connection failed: ' . $conn->connect_error);
        // }
        // $conn->set_charset('utf8');
        // // $str = "insert into tbl_product VALUES ('$product_id', '$category_id', '$product_name', '$product_desc', '$product_content', '$product_price', '$product_image', '$product_color', '$category_status')";
        // $sql = "INSERT INTO tbl_product(product_id, category_id, product_name, product_desc, product_content, product_price, product_image, product_color, product_status) VALUES ('52' , '1' , 'Vòng Tay đá thạch anh đào mix charm bạc mặt trăng ngôi sao' , 'a' , 'b' , '752000' , 'main_img_1.jpg' , '1' , '1' )";
    
        // $conn->query($sql)
        // $conn->close();
        
        $product=$_GET['proid'];
        $size=$_GET['prosize'];
        $customer=$_GET['customer'];
        $quantity=$_GET['proquantity'];

        $existingRecord=DB::table('tbl_cart')
        ->where('product_id', $product)
        ->where('size_id', $size)
        ->where('customer_id', $customer)
        ->first();

        if ($existingRecord === null) 
        {//nếu rỗng->chưa có->thêm vào
            $data=[];
            $data['product_id']=$product;
            $data['size_id']=$size;
            $data['customer_id']=$customer;
            $data['cart_quantity']=$quantity;
            DB::table('tbl_cart')->insert($data);
   
        } 
        else 
        { 
            //tức là đã có thì cộng dồn lên
            $inventory = DB::table('tbl_cart')->join('tbl_product_details', function ($join) {
            $join->on('tbl_cart.product_id', '=', 'tbl_product_details.product_id')
                 ->on('tbl_cart.size_id', '=', 'tbl_product_details.size_id');})
            ->where('tbl_cart.size_id', $size)
            ->where('tbl_cart.product_id', $product)
            ->pluck('SL')
            ->first();

            $new_quantity=$existingRecord->cart_quantity + $quantity;
            $new_quantity = min($new_quantity, $inventory);//nếu số lượng chọn lớn hơn tồn kho thì set=tồn kho

            DB::table('tbl_cart')->where('product_id', $product)->where('size_id', $size)->where('customer_id', $customer)
            ->update(['cart_quantity'=>$new_quantity]);
        }

    }
    ?>
        

</body>

</html>