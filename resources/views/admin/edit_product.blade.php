@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật sản phẩm
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
                                @foreach($edit_product as $key =>$product)
                                <form role="form" action="{{URL::to('/update-product/'.$product->product_id)}}" method="post" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text" class="form-control" name="product_name" id="exampleInputEmail1" value="{{$product->product_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="text" class="form-control" name="product_price" id="exampleInputEmail1" value="{{$product->product_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh sản phẩm</label>
                                    <input type="file" class="form-control" name="product_image" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/uploads/product/'.$product->product_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                    <textarea style="resize:none" rows="6" name="product_desc"  class="form-control" id="exampleInputPassword1">{{$product->product_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                    <textarea style="resize:none" rows="6" name="product_content"  class="form-control" id="productContent" >{{$product->product_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Kích cỡ</label>
                                    <select name="product_size" class="form-control input-sm m-bot15" value="{{$product->product_size}}">
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>

                                    </select>                                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1"> Số lượng</label>
                                    <input type="number" class="form-control" name="product_number" id="exampleInputEmail1" value="{{$product->product_number}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name="category_id" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                           @if($cate->category_id==$product->category_id)
                                           <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                           @else
                                           <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                           @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="update_product" class="btn btn-info">Cập nhật</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
@endsection