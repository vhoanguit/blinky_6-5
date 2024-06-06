@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật sản phẩm
                </header>
                <div class="panel-body">
                @if(Session::get('message'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: '{{ Session::get('message') }}'
                    });
                    
                </script>
                <?php
                    Session::put('message',null);
                ?>
                @endif
                    <div class="position-center">
                        @foreach ($edit_product as $key => $pro)
                            <form role="form" action="{{ URL::to('/update-product/' . $pro->product_id) }}" method="POST"
                                enctype="multipart/form-data">{{-- enctype="multipart/form-data": để thêm ảnh --}}
                                {{ csrf_field() }}
                                {{-- token để bảo mật form --}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control"
                                        value="{{ $pro->product_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                    <input type="file" name="product_image" class="form-control">
                                    <br>
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" height="100"
                                        width="100" style='object-fit: cover'>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" name="product_price" class="form-control"
                                        value="{{ $pro->product_price }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Màu sắc</label>
                                    <select id="product_color" name="product_color" class="form-control input-sm m-bot15">
                                        <option value="Hồng" {{ $pro->product_color == 'Hồng' ? 'selected' : '' }}>Hồng</option>
                                        <option value="Xanh dương" {{ $pro->product_color == 'Xanh dương' ? 'selected' : '' }}>Xanh dương</option>
                                        <option value="Vàng" {{ $pro->product_color == 'Vàng' ? 'selected' : '' }}>Vàng</option>
                                        <option value="Xanh lục" {{ $pro->product_color == 'Xanh lục' ? 'selected' : '' }}>Xanh lục</option>
                                        <option value="Đỏ" {{ $pro->product_color == 'Đỏ' ? 'selected' : '' }}>Đỏ</option>
                                        <option value="Cam" {{ $pro->product_color == 'Cam' ? 'selected' : '' }}>Cam</option>
                                        <option value="Tím" {{ $pro->product_color == 'Tím' ? 'selected' : '' }}>Tím</option>
                                        <option value="Nâu" {{ $pro->product_color == 'Nâu' ? 'selected' : '' }}>Nâu</option>
                                        <option value="Trắng" {{ $pro->product_color == 'Trắng' ? 'selected' : '' }}>Trắng</option>
                                    </select>
                                    {{-- <script>
                                var color={{ $pro->product_color }}
                                console.log({{ $pro->product_color }} );
                                alert("as");
                                var selectElement=document.getElementById('product_color');
                                for (var i = 0; i < selectElement.options.length; i++) 
                                {
                                    if (selectElement.options[i].value == color) {
                                        selectElement.selectedIndex = i;
                                        break;
                                    }
                                }
                            </script> --}}
                                </div>
                                <label for="exampleInputPassword1">Mệnh</label>
                                    <select id="product_color" name="product_element" class="form-control input-sm m-bot15">
                                        <option value="Kim" {{ $pro->product_element == 'Kim' ? 'selected' : '' }}>Kim</option>
                                        <option value="Mộc" {{ $pro->product_element == 'Mộc' ? 'selected' : '' }}>Mộc</option>
                                        <option value="Thủy" {{ $pro->product_element == 'Thủy' ? 'selected' : '' }}>Thủy</option>
                                        <option value="Hỏa" {{ $pro->product_element == 'Hỏa' ? 'selected' : '' }}>Hỏa</option>
                                        <option value="Thổ" {{ $pro->product_element == 'Thổ' ? 'selected' : '' }}>Thổ</option>
                                    </select>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="cate_product" class="form-control input-sm m-bot15">
                                        @foreach ($cate_product as $key => $cate)
                                            @if ($cate->category_id == $pro->category_id)
                                                <option selected value="{{ $cate->category_id }}">
                                                    {{ $cate->category_name }}</option>
                                            @else
                                                <option value="{{ $cate->category_id }}">{{ $cate->category_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize: none" rows="5" name="product_desc" class="form-control" id="noidung">{{ $pro->product_desc }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize: none" rows="5" name="product_content" class="form-control" id="tomtat">{{ $pro->product_content }}</textarea>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                            </form>
                    </div>
                    @endforeach
                </div>
            </section>

        </div>
    @endsection