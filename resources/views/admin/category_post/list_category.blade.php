@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả danh mục bài viết
    </div>
    <!-- <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
    <div class="table-responsive">
      <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">'.$message.'</span>';
                Session::put('message',null);
            }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <!-- <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th> -->
            <th>Tên danh mục bài viết</th>
            <th>Slug</th>
            <th>Trạng thái</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($category_post as $key => $cate_post) 
          <!--lặp qua mỗi phần tử của mảng $category_post. Biến $key sẽ lưu chỉ số (hoặc khóa nếu là mảng kết hợp) của mảng, và $cate_post sẽ chứa thông tin của mỗi phần tử danh mục bài viết.-->
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $cate_post->cate_post_name }}</td>
            <td>{{ $cate_post->cate_post_slug }}</td>
            <td>
                <!-- @if($cate_post->cate_post_status==1)
                    Hiển thị
                @else 
                    Ẩn
                @endif -->
                @if($cate_post->cate_post_status==1) <a href="{{URL::to('/unactive-cate-post/'.$cate_post->cate_post_id)}}"><span style="color:green;font-size:20px" class=" fa fa-thumbs-up"></span></a>          
                @else <a href="{{URL::to('/active-cate-post/'.$cate_post->cate_post_id)}}"><span style="color:red;font-size:20px" class=" fa fa-thumbs-down"></span></a>          
              
                @endif


            </td>       
            <td>
              <a href="{{URL::to('/edit-category-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc muốn xóa bài viết này không?')" href="{{URL::to('/delete-category-post/'.$cate_post->cate_post_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
             {!!$category_post->links()!!} <!--Nhóm các nút phân trang để di chuyển lại giữa các trang (previous,next) -->
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection