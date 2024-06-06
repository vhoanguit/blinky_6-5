@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                          Cập nhật danh mục bài viết
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
                                <form role="form" action="{{URL::to('/update-category-post/'.$category_post->cate_post_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục bài viết</label>
                                    <input type="text" name="cate_post_name" value="{{$category_post->cate_post_name}}" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug</label>
                                    <input type="text" name="cate_post_slug" value="{{$category_post->cate_post_slug}}" class="form-control" id="convert_slug" placeholder="Slug">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục bài viết </label>
                                    <textarea style="resize: none" rows="8" value="{{$category_post->cate_post_desc}}" class="form-control" name="cate_post_desc" id="exampleInputPassword1" placeholder="Mô tả danh mục">{{$category_post->cate_post_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                      <select name="cate_post_status" class="form-control input-sm m-bot15">
                                        @if($category_post->cate_post_status==1)
                                            <option selected value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                        @else
                                            <option value="1">Hiển thị</option>
                                            <option selected value="0">Ẩn</option>
                                        @endif
                                            
                                    </select>
                                </div>
                               
                                <button type="submit" name="update_post_cate" class="btn btn-info">Cập nhât danh mục bài viết </button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
@endsection