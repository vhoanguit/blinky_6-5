<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    
    <link href="{{ asset('public/frontend/css/sanpham.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/themes/base/jquery-ui.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sản phẩm | Blinkiy</title>
</head>

<body>
    @include('Header')

        <div class="container-fluid"> <!-- /*CHỌN LOẠI HIỂN THỊ*/ -->
            <div class="filter-bar"> 
                <!-- /*BỘ LỌC DANH MỤC SẢN PHẨM*/ -->
                @foreach($category as $key =>$cate)
                    <div class="category">  
                        <a class="category-title-1" href=" {{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{$cate->category_name}}</a>
                        <br><br>
                    </div>
                @endforeach
                <div class="category"> 
                    <!-- <a class="category-title-1" href=" {{ URL::to('/san-pham') }}">Xem tất cả</a> -->
                </div> 
                <br><hr>

                <div class="category">
                    <h4 class="category-title-3">Màu sắc</h4>
    
                    <form method="GET">
                        
                        <input type="hidden" id="selectedColors" name="selectedColors" value="{{ json_encode($selectedColors) }}">
                        <ul class="">
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="hồng"> Hồng</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="xanh dương"> Xanh dương</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="vàng"> Vàng</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="xanh lục"> Xanh lục</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="đỏ"> Đỏ</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="cam"> Cam</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="tím"> Tím</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="nâu"> Nâu</li>
                            <li><input type="checkbox" class="checkbox_color" name="filter[]" id=""
                                    onclick="MakeFilter()" value="trắng"> Trắng</li>
                        </ul>
                        <script>
                            
                        </script>
                </div>
                
                <br>
                <hr>
    
                <div class="category">
                    <h4 class="category-title-3">Mệnh phong thủy</h4>
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
                    <h4 class="category-title-3">Khoảng giá</h4>
    
                    <input type="text" id="amount" readonly="">
                    <div id="slider-range"></div>
                    <input type="hidden" class="price_from" name="price_from" id="price_from" value="{{ $min_price_value }}">
                    <input type="hidden" class="price_to" name="price_to" id="price_to" value="{{ $max_price_value }}">
    
                </div>
                <br><br>
                <div class="filter-submit">
                    <input type="submit" class="filter-price" name="filter-price" value="Lọc sản phẩm">
                </div>
                </form>
    
            </div>

            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="product-list">
                <!-- THANH SEARCH -->
                <form action="{{URL::to('/tim-kiem')}}" method="get">
                <!--Style lại class "search-bar" thành "search_product",style lại "input-group" , thêm class "search_button_product" và "search_input_product"-->
                    <div class="search_product">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control search_input_product" placeholder="Tìm kiếm sản phẩm"
                                    aria-describedby="addon-wrapping" name="keywords_submit"
                                    value="{{ $keywords }}">
                                <input type="submit" name="search_items" class="search_button_product" value="Search"/>
                            </div>
                    </div>
                <!--Style lại class "search-bar" thành "search_product",style lại "input-group" , thêm class "search_button_product" và "search_input_product"-->
                </form>
                <!-- SẢN PHẨM -->
                <div class="products">
                    @foreach($search_product as $key=> $product)
                    <div class="product-card">
                        <div class="product-image">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}">
                                <img src="{{ URL::to('public/uploads/product/'.$product->product_image) }}" alt="">
                            </a>
                        </div>
                        <div class="product-info">
                            <a class="product-name" href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}">{{ $product->product_name}}</a>
                            <p class="product-price">{{number_format ($product->product_price) .' '.'VNĐ'}}</p>
                        </div>
                    </div>
                    @endforeach
                {{-- <br> --}}
                </div>
                <div class="navigator">
                    {{ $search_product->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
        </div>
    </section>

 
<script src="{{ asset('public/frontend/js/sanpham.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
{{-- <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>

<script>
    $(document).ready(function ()
    {
        $( "#slider-range" ).slider({
        orientation: "horizontal",//chiều ngang
        range: true,
        
        min: {{ $min_price_range}},
        max : {{ $max_price_range }},
        values: [ {{ $min_price_value }} , {{ $max_price_value}} ],
        step: 1000,

        slide: function( event, ui ) {
            $( "#amount" ).val( addPlus(ui.values[ 0 ]) + " VNĐ" + " - " + addPlus(ui.values[ 1 ]) + " VNĐ" );//cộng/ trừ giá trị vào khi di chuyển
            $('#price_from').val(ui.values[ 0 ]);
            $('#price_to').val(ui.values[ 1 ]);
        }
        });
        $( "#amount" ).val( addPlus($( "#slider-range" ).slider( "values", 0 ))+" VNĐ" + " - " + addPlus($( "#slider-range" ).slider( "values", 1 ) )+" VNĐ" );//hiển thị ra bên ngoài
        //$( "#amount" ).val( addPlus($( "#slider-range" ).slider( "values", 0 ))+" VNĐ" + " - " + addPlus($( "#slider-range" ).slider( "values", 1 ) )+" VNĐ" );//hiển thị ra bên ngoài

    });
    function addPlus(nStr)//fromat định dạng tiền 
    {
        nStr += '';
        x = nStr.split(',');
        x1 = x[0];
        x2 = x.length > 1 ? ',' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
</script>

</body>
@include('Footer')

</html>
