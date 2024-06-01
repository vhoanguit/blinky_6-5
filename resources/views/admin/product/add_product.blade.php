@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm sản phẩm
                        </header>

                        <div class="panel-body">
                        <?php
                            $message = Session::get('message'); // hàm get để lấy biến có tên là 'message' ở bên AdminController
                            if($message){ // neu ton tai message
                                echo '<span class="text-alert">'.$message.'</span>' ; // in ra tin nhan
                                Session::put('message',null); //cho hien thi 1 lan thoi
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize:none" rows="6" name="product_desc"  class="form-control" id="motaSp" placeholder="Mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize:none" rows="6" name="product_content"  class="form-control" id="noidungSp" placeholder="Nội dung danh mục"></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="exampleInputPassword1"> Kích cỡ</label>
                                    <select name="product_size" class="form-control input-sm m-bot15">
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>

                                    </select>                                
                                </div> -->
                                
                                <!-- <div class="form-group">
                                    <label for="exampleInputPassword1"> Số lượng</label>
                                    <input type="number" class="form-control" name="product_number" id="exampleInputEmail1" placeholder="Sô lượng sản phẩm">
                                </div> -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Màu sắc</label>
                                    <select name="product_color" class="form-control input-sm m-bot15">
                                        <option value="0">Hồng</option>
                                        <option value="1">Xanh lam</option>
                                        <option value="2">Vàng</option>
                                        <option value="3">Xanh lục</option>
                                        <option value="4">Đỏ</option>
                                        <option value="5">Cam</option>
                                        <option value="6">Tím</option>
                                        <option value="7">Nâu</option>
                                        <option value="8">Trắng</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mệnh</label>
                                    <select name="product_element" class="form-control input-sm m-bot15">
                                        <option value="Kim">Kim</option>
                                        <option value="Mộc">Mộc</option>
                                        <option value="Thủy">Thủy</option>
                                        <option value="Hỏa">Hỏa</option>
                                        <option value="Thổ">Thổ</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @foreach ($size as $key => $size_val)
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng hàng Size
                                        {{ $size_val->size_value }}</label>
                                    <input type="number" name="product_size_sl[]" class="form-control" min="0"
                                        step="1" value="0">
                                </div>
                                @endforeach
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection