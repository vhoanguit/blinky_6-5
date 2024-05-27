@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            Tất cả bài viết
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
            <th>Tên</th>
            <th>Hình ảnh</th>
            <th>Slug</th>
            <th>Mô tả</th>
            <th>Từ khóa </th>
            <th>Danh mục</th>
            <th>Trạng thái</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_post as $key => $post)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $post->post_title}}</td>
            <td><img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100"></td>
            <td>{{ $post->post_slug}}</td>
            <td>{!!$post->post_desc!!}</td> 
            <!-- chuyen thanh html k bi loi -->
            <td>{{ $post->post_meta_keywords}}</td>
            <td>{{ $post->cate_post->cate_post_name }}</td> <!--Lay ra ten danh muc thay vi id danh muc trong table cate_post, vì trường catepostname k có trong table post-->
            <td>
                <!-- @if($post->post_status==0)
                    Hiển thị  
                @else
                    Ẩn               
                @endif -->
                @if($post->post_status ==1) <a href="{{URL::to('/unactive-post/'.$post->post_id)}}"><span style="color:green;font-size:20px" class=" fa fa-thumbs-up"></span></a>          
                @else <a href="{{URL::to('/active-post/'.$post->post_id)}}"><span style="color:red;font-size:20px" class=" fa fa-thumbs-down"></span></a>          
              
                @endif
            </td>          
            <td>
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa bài viết này không?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
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
            {!!$all_post->links()!!}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection