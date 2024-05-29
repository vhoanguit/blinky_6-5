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
                        <form role="form" action="{{ URL::to('/update-product-details/'.$pro_id) }}" method="POST" enctype="multipart/form-data">
                            {{-- enctype="multipart/form-data": để thêm ảnh --}}
                        {{ csrf_field() }} 
                        @foreach ($edit_product as $key => $pro)
                        <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng size {{ $pro->size_value }}</label>
                            <input type="number" name="product_size_sl[]" class="form-control" min="0" step="1" value="{{ $pro->SL }}">
                        </div>    
                        @endforeach
                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                    </form>
                    </div>
                   
                </div>
            </section>

    </div>
@endsection