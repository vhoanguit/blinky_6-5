
<link href="{{ asset('public/frontend/css/StyleInsideProduct.css') }}" rel="stylesheet">

@extends('copy_layout')
@section('inside_product')
    @foreach ($product as $key => $pro)
        <section class="inside_product_section">
           

            <div class="filter_from_product_page">
                <p>
                    <br>
                    <a href="{{ URL::to('/san-pham') }}"><span id="product_name">Sản phẩm</span></a>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="color:#EF99A2"
                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                    @foreach ($cate_of_product as $key => $cate)
                        <a href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}"><span
                                id="filter_link_from_name">{{ $cate->category_name }}</span></a>
                    @endforeach

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="color:#EF99A2"
                        class="bi bi-chevron-right" viewBox="0 0 16 16">
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16" >
                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>
                            </svg>
                        </button>
                        <img id="main_image" src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}">
                        <button class="right_btn" style="display: block;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16" >
                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                              </svg>
                        </button>
                    </div>
                    <p>
                        <div class="extra_images">
                            
                        </div>
                        <br>
                    </p>
                </div>

                <hr>

                <div class="container">
                    <div class="product_container">

                        <h3 class="cart_product_name_{{$pro->product_id}}" id="title"><b>{{ $pro->product_name }}</b></h3>
                        <br>
                        <div id="price_of_product_hihi" class="price">{{ number_format($pro->product_price) . ' ' . 'VNĐ' }}</div>

                        <div class="size_container">
                            <p id="size_of_product">Kích cỡ</p>
                            
                            @foreach ($size as $key => $size_pro)
                                @if($size_pro->SL>0)
                                    <button type="button" class="size"
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
                                <input class="cart_product_number_{{$pro->product_id}}" type="text" name="amountnumber" id="amountnumber" value="1">
                                <button class="plus" id="plus_btn" onclick="handlePlus()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                </button>

                                <div id="quantity_of_product">
                                    <?php
                                        $sum=0;
                                        foreach($size as $key =>$proSL)
                                        {
                                            $sum+=$proSL->SL;
                                        }
                                        echo "<p>$sum"." sản phẩm có sẵn</p>";
                                    ?>
                                </div>
                            </div>

                        </div>

                        <hr>
                    </div>

                    <div class="button_container">
                        <div class="addtocart_container">
                            <form method="POST" action="{{ URL::to('/add-to-cart') }}">
                            <!-- <form> -->
                                {{ csrf_field() }}
                                <input type="hidden" id="productid_hidden" class="cart_product_id_{{$pro->product_id}}"  value="{{ $pro->product_id }}">
                                <input class="cart_product_name_{{$pro->product_id}}" type="hidden"   value="{{$pro->product_name}}">
                                <input class="cart_product_quantity_{{$pro->product_id}}" type="hidden"   value="1">
                                <input class="cart_product_price_{{$pro->product_id}}" type="hidden"   value="{{$pro->product_price}}">
                                <input class="cart_product_image_{{$pro->product_id}}" type="hidden"   value="{{$pro->product_image}}">
                                <input class="cart_product_size_{{$size_pro->size_value}}" type="hidden"   value="{{$size_pro->size_value}}">

                                <button type="button" id="add_product_to_cart" name="add-to-cart" data-id="{{$pro->product_id}}"  onclick="addToCart()">
                                    <!-- <span class="cart-icon">🛒</span> -->
                                    <!-- <input type="hidden" id="productid_hidden" class="cart_product_id_{{$pro->product_id}}" name="productid_hidden" value="{{ $pro->product_id }}"> -->
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
                                        <path d="M5.52.359A.5.5 0 0 1 6 0h4a.5.5 0 0 1 .474.658L8.694 6H12.5a.5.5 0 0 1 .395.807l-7 9a.5.5 0 0 1-.873
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
                            {!!$pro->product_content!!}
                        </span>
                    </p>
                    <br>
                    <p>
                        <b>Mô tả chi tiết:&nbsp;</b>
                    </p>
                    <p class="text_content">
                        <span style="font-family: 'Arial',sans-serif;">
                            {!!$pro->product_desc!!}
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
                                        <a
                                            href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">{{ $related_pro->product_name }}</a>
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

    </section>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('public/frontend/js/InsightProduct.js') }}"></script> <!--Này thêm để làm cái thêm giỏ hàng với mua ngay nè-->
@endsection


