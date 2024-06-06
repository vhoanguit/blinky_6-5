@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
          <div class="panel-heading">
            Tất cả bài viết
          </div>
   
    <div class="table-responsive">
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
          <th style=" display: table-cell; width:50px;vertical-align: middle;text-align: center">STT</th>
            <th style="width:200px; vertical-align: middle;">Tên</th>
            <th style="vertical-align: middle;text-align: center">Hình ảnh</th>
            <th style="width:300px;vertical-align: middle;">Mô tả</th>
            <th style="vertical-align: middle;text-align: center">Danh mục</th>
            <th style="vertical-align: middle;text-align: center"> Trạng thái</th>           
            <th style="width:90px;vertical-align: middle;text-align: center">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_post as $key => $post)
          <tr>
          <td style=" display: table-cell; text-align: center;vertical-align: middle;">
                {{ ($all_post->currentPage() - 1) * $all_post->perPage() + $key + 1 }}</td>            
                <td style="vertical-align: middle;">{{ $post->post_title}}</td>
            <td style="vertical-align: middle; text-align: center"><img src="{{asset('public/uploads/post/'.$post->post_image)}}" height="100" width="100"></td>
            <td style="vertical-align: middle;">{!!$post->post_desc!!}</td> 
            <!-- chuyen thanh html k bi loi -->
            <td style="vertical-align: middle; text-align: center">{{ $post->cate_post->cate_post_name }}</td> <!--Lay ra ten danh muc thay vi id danh muc trong table cate_post, vì trường catepostname k có trong table post-->
            <td style="vertical-align: middle; text-align: center">
                
            @if($post->post_status == 1) 
                <i style="color:green; cursor:pointer" class="fa-solid fa-eye update-post-status" data-id="{{$post->post_id}}" data-status="0"></i>          
            @else 
                <i style="color:red; cursor:pointer" class="fa-solid fa-eye-slash update-post-status" data-id="{{$post->post_id}}" data-status="1"></i>          
            @endif

            </td>          
            <td style="vertical-align: middle; text-align: center">
              <a href="{{URL::to('/edit-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-pen-to-square"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa bài viết này không?')" href="{{URL::to('/delete-post/'.$post->post_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer" style="height: 100px; display: flex; justify-content: center; align-items: center;">
      <div>       
          {{ $all_post->links('pagination::bootstrap-4') }}
      </div>
    </footer>
  </div>
</div>
<script>
$(document).ready(function(){
    $('.update-post-status').click(function(event){
        event.preventDefault();
        var postId = $(this).data('id'); // lấy ID bài viết
        var postStatus = $(this).data('status'); // lấy trạng thái mới
        var element = $(this);
        $.ajax({
            url: "{{ url('/update-post-status') }}", // đường dẫn tới route xử lý cập nhật
            method: 'GET',
            data:{post_id: postId, post_status: postStatus},
            success:function(data){              
                if(postStatus == 1) {
                  element.removeClass('fa-eye-slash').addClass('fa-eye').css('color', 'green').data('status', 0);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Hiển thị bài viết thành công!'
                  });
                } 
                else {
                  element.removeClass('fa-eye').addClass('fa-eye-slash').css('color', 'red').data('status', 1);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Ẩn bài viết thành công!'
                  });
                }
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
              console.log('AJAX call failed: ' + textStatus + ', ' + errorThrown);
            }
        });
    });
});
</script>

@endsection