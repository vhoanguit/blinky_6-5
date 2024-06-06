@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật danh mục sản phẩm
                        </header>
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
                        <div class="panel-body">
                            @foreach($edit_category_product as $key => $edit_value)
                        
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" value="{{$edit_value->category_name}}" class="form-control" name="category_product_name" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea style="resize:none" rows="6" name="category_product_desc"  class="form-control" id="exampleInputPassword1" >{{$edit_value->category_desc}}</textarea>
                                </div>
                                
                                
                                <button type="submit" name="update-category-product" class="btn btn-info">Cập nhật</button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>

            </div>
@endsection