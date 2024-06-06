@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm bài viết
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

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-post')}}" method="post" enctype='multipart/form-data'>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên bài viết</label>
                                        <input type="text" name="post_title" class="form-control" id="slug" placeholder="Tên bài viết">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="post_desc" id="tomtat" placeholder="Tóm tắt bài viết"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung bài viết</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="post_content" id="noidung" placeholder="Nội dung bài viết"></textarea>
                                        <!--id="ckeditor" là trình soan thảo đc style sẵn-->
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Meta từ khóa</label>
                                        <textarea style="resize: none" rows="5" class="form-control" name="post_meta_keywords" id="exampleInputPassword1" placeholder="Meta từ khóa"></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                        <input type="file" name="post_image" class="form-control" id="exampleInputEmail1">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục bài viết</label>
                                            <select name="cate_post_id" class="form-control input-sm m-bot15">
                                            @foreach($cate_post as $key => $cate) 
                                                    <option value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                                @endforeach

                                                
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="post_status" class="form-control input-sm m-bot15">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Ẩn</option>
                                                
                                        </select>
                                    </div>
                                
                                    <button type="submit" name="add_category_product" class="btn btn-info">Thêm bài viết</button>
                                </form>
                            </div>

                        </div>
                    </section>
                    

            </div>
@endsection