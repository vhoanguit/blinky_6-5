@extends('copy_layout')
@section('product')
    <!-- -----TRANG SẢN PHẨM----- -->

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
                    <a class="category-title-1" href=" {{ URL::to('/san-pham') }}">Xem tất cả</a>
                </div> 
                <br><hr>

                <div class="category"> 
                    <h4 class="category-title-1">Màu sắc</h4>
                    <ul class="">
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Xanh dương</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Đỏ</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Vàng</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Trắng</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Đen</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Hồng</li>
                        <li><input type="checkbox" class="checkbox_color" name="" id=""> Xanh lá</li>
                    </ul>
                </div>
                <br><hr>

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
                <br><hr>

                <div class="category">
                    <h4 class="category-title-1">Khoảng giá</h4>
                    <div class="d-flex justify-content-between">
                        <p>1.000.000</p>
                        <p>5.000.000</p>
                    </div>
                    <!-- Thanh giá  -->
                    <input type="range" class="form-range" id=""> 
                </div>
            </div>

            <!-- DANH SÁCH SẢN PHẨM -->
            <div class="product-list">
                <!-- THANH SEARCH -->
                <form action="{{URL::to('/tim-kiem')}}" method="post">
                {{ csrf_field() }}             
                <!--Style lại class "search-bar" thành "search_product",style lại "input-group" , thêm class "search_button_product" và "search_input_product"-->
                    <div class="search_product">
                            <div class="input-group flex-nowrap">
                                <input type="text" class="form-control search_input_product" placeholder="Tìm kiếm sản phẩm"
                                    aria-describedby="addon-wrapping" name="keywords_submit">
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
                <br>
                </div>
                <div class="navigator">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D0933E" class="bi bi-chevron-left"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                    </svg>
                    <div class="page-number active">1</div>
                    <div class="page-number">2</div>
    
                    <div class="page-number">3</div>
                    <div class="page-number">4</div>
    
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#D0933E"
                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                    </svg>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection