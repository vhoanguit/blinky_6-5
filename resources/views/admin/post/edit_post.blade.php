@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Cập nhật bài viết
                        </header>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-post/'.$post->post_id)}}" method="post" enctype='multipart/form-data'>
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên bài viết</label>
                                        <input type="text" name="post_title" class="form-control" value="{{$post->post_title}}" id="slug" placeholder="Tên bài viết">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Slug</label>
                                        <input type="text" name="post_slug" class="form-control" value="{{$post->post_slug}}" id="convert_slug" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tóm tắt bài viết</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="post_desc" id="tomtat" placeholder="Tóm tắt bài viết">{{$post->post_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nội dung bài viết</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="post_content" id="noidung" placeholder="Nội dung bài viết">{{$post->post_content}}</textarea>
                                   
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Meta từ khóa</label>
                                        <textarea style="resize: none" rows="8" class="form-control" name="post_meta_keywords"  placeholder="Meta từ khóa">{{$post->post_meta_keywords}}</textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                                        <input type="file" name="post_image" class="form-control" >
                                        <img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Danh mục bài viết</label>
                                        <select name="cate_post_id" class="form-control input-sm m-bot15">
                                            @foreach($cate_post as $key => $cate) 
                                                <option {{$post->cate_post_id == $cate->cate_post_id ? 'selected' : ''}} value="{{$cate->cate_post_id}}">{{$cate->cate_post_name}}</option>
                                            @endforeach                                           
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Hiển thị</label>
                                        <select name="post_status" class="form-control input-sm m-bot15">
                                        @if($post->post_status ==1){
                                            <option selected value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        }
                                        @else{
                                            <option value="1">Hiển thị</option>
                                            <option selected value="0">Ẩn</option>
                                        } 
                                        @endif                                      
                                        </select>
                                    </div>        
                                    <button type="submit" name="update_category_post" class="btn btn-info">Cập nhật bài viết</button>
                                </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection