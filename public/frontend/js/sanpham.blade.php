@extends('copy_layout')
@section('product')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="container-fluid"> <!-- /*CHỌN LOẠI HIỂN THỊ*/ -->
        <div class="filter-bar">
            <!-- /*BỘ LỌC DANH MỤC SẢN PHẨM*/ -->
            @foreach ($category as $key => $cate)
                <div class="category">
                    <a class="category-title-1"
                        href=" {{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                </div>
                <br>
            @endforeach
            <br>
            <hr>

            <div class="category">
                <h4 class="category-title-1">Màu sắc</h4>

                <form 
                {{-- method="GET" --}}
                method="POST">
                    {{-- {{csrf_field()}} --}}
                    {{-- @csrf --}}
                    <ul class="">
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="0"> Hồng</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="1"> Xanh lam</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="2"> Vàng</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="3"> Xanh lục</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="4"> Đỏ</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="5"> Cam</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="6"> Tím</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="7"> Nâu</li>
                        <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                onclick="MakeFilter()" value="8"> Trắng</li>
                    </ul>

                    {{-- </form> --}}
            </div>
            
            <br>
            <hr>

            <div class="category">
                <h4 class="category-title-1">Mệnh phong thủy</h4>
                <ul>
                    <li><input type="checkbox" class="checkbox_menh" name="" id=""> Kim</li>
                    <li><input type="checkbox" class="checkbox_menh" name="" id=""> Mộc</li>
                    <li><input type="checkbox" class="checkbox_menh" name="" id=""> Thủy</li>
                    <li><input type="checkbox" class="checkbox_menh" name="" id=""> Hỏa</li>
                    <li><input type="checkbox" class="checkbox_menh" name="" id=""> Thổ</li>

                </ul>
            </div>
            <br>
            <hr>

            <div class="category">
                <h4 class="category-title-1">Khoảng giá</h4>

                {{-- <form method="GET"> --}}
                <input type="text" id="amount" readonly="">
                <div id="slider-range"></div>
                <input type="hidden" class="price_from" name="price_from" id="price_from" value="{{ $min_price_value }}">
                <input type="hidden" class="price_to" name="price_to" id="price_to" value="{{ $max_price_value }}">

            </div>
            <br><br>
            {{-- <hr> --}}

            <div class="filter-submit">

                <input type="submit" class="filter-price" name="filter-price" value="Lọc sản phẩm">
            </div>
            </form>

            <br><br><br><br><br>
        </div>

        <!-- DANH SÁCH SẢN PHẨM -->
        <div class="product-list">
            <!-- THANH SEARCH -->
            <form action="{{ URL::to('/tim-kiem') }}" method="post">
                {{ csrf_field() }}
                <!--Style lại class "search-bar" thành "search_product",style lại "input-group" , thêm class "search_button_product" và "search_input_product"-->
                <div class="search_product">
                    <div class="input-group flex-nowrap">
                        <input type="text" class="form-control search_input_product" placeholder="Tìm kiếm sản phẩm"
                            aria-describedby="addon-wrapping" name="keywords_submit">
                        <input type="submit" name="search_items" class="search_button_product" value="Search" />
                    </div>
                </div>
                <!--Style lại class "search-bar" thành "search_product",style lại "input-group" , thêm class "search_button_product" và "search_input_product"-->
            </form>
            {{-- <div class="search-bar">
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg></span>

                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm"
                        aria-describedby="addon-wrapping">
                </div>
            </div> --}}

            <!-- SẢN PHẨM -->
            <div id="products" class="products">
                @foreach ($product as $key => $pro)
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">
                                <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a class="product-name"
                                href="{{ URL::to('/chi-tiet-san-pham/' . $pro->product_id) }}">{{ $pro->product_name }}</a>
                            <p class="product-price">{{ number_format($pro->product_price) . ' ' . 'VNĐ' }}</p>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="navigator">
                {{ $product->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </div>
    </div>

    </section>
    <script type="text/javascript">
        function MakeFilter() {
                //alert("sdaa");
                // var currentURL = window.location.href; // Tìm vị trí của dấu gạch chéo cuối cùng
                // var lastSlashIndex = currentURL.lastIndexOf('/'); // Lấy phần cuối cùng của đường link (phần chứa số 11)
                // var numberString = currentURL.substring(lastSlashIndex + 1); // Chuyển đổi chuỗi số thành số nguyên
                // var number = parseInt(numberString);
                // console.log(number);

                var obj = document.getElementById('products');
                var filter = document.getElementsByClassName("checkbox_color");
                var filter_checked = [];

                var url;

                //Bộ lọc theo màu
                for (let i = 0; i < filter.length; i++) {
                    if (filter[i].checked) {
                        filter_checked.push(filter[i].value);
                    }
                }
                var min_price = document.getElementById("price_from").value;
                var max_price = document.getElementById("price_to").value;

                // var token = $('meta[name="csrf-token"]').attr('content');
                var token = $('input[name="_token"]').val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    // url: "{{ url::to('/filter-products') }}",

                    // url: "{!! url('/filter-products') !!}"",; 
                    url: "{{ url('/filter-products') }}",
                    //url: '{{ URL::to('/filter-products') }}', // URL của route Laravel
                    contentType: 'application/json',
                    data: JSON.stringify({
                        //_token: token, // Thêm CSRF token
                        filter_checked: filter_checked,
                        min_price: min_price,
                        max_price: max_price,
                        //additional_param: additionalParam // Thêm tham số tùy chọn
                    }),

                    success: function(response) {
                        if (response.success) {
                            obj.innerHTML = "asasdas";
                        } else {
                            alert('Failed to filter products');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        obj.innerHTML = "asasdas";
                        console.log('AJAX call failed: ' + textStatus + ', ' + errorThrown);
                    }
                });
            }
    </script>
    {{-- <script type="text/javascript" src="{{ asset('public/frontend/js/MakeFilter.js') }}"></script> --}}
@endsection
