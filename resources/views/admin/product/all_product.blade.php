@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    
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
            <th style="width:150px;">Tên</th>
            <th>Danh mục</th>     
            <th>Giá</th>
            <th>Hình ảnh</th>
            <th>Màu sắc</th>
            <th>Mệnh</th>
            <th>Trạng thái</th>   
            <th>Thao tác</th>        
            <!-- <th style="width:30px;"></th> -->
          </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
            <!-- <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td> -->
            <td>{{ $pro->product_name }}</td>
            <td>{{ $pro->category_name}}</td>
            <td>{{ $pro->product_price}}</td>
            <td><img src="public/uploads/product/{{$pro->product_image}}" height="100" width="100"></td>
            <td>{{$pro->product_color }}</td>
            <td>{{$pro->product_element }}</td>


            <td><span class="text-ellipsis">
            @if($pro->product_status == 1) 
                <i style="color:green; cursor:pointer" class="fa-solid fa-eye update-pro-status" data-id="{{$pro->product_id}}" data-status="0"></i>          
            @else 
                <i style="color:red; cursor:pointer" class="fa-solid fa-eye-slash update-pro-status" data-id="{{$pro->product_id}}" data-status="1"></i>          
            @endif
            </span></td>
           
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-pen-to-square"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
              <a href="{{ URL::to('/add-gallery/'.$pro->product_id) }}" ><i class="fa fa-solid fa-image" style="color: #9E75FF"></i>
              <a href="{{URL::to('/show-product-details/'.$pro->product_id) }}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-circle-info"></i>                        
            </a><br>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <!-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> -->
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          {{ $all_product->links('pagination::bootstrap-4') }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
<script>
$(document).ready(function(){
    $('.update-pro-status').click(function(event){
        event.preventDefault();
        var proId = $(this).data('id'); // lấy ID bài viết
        var proStatus = $(this).data('status'); // lấy trạng thái mới
        var element = $(this);
        $.ajax({
            url: "{{ url('/update-product-status') }}", // đường dẫn tới route xử lý cập nhật
            method: 'GET',
            data:{product_id: proId, product_status: proStatus},
            success:function(data){              
                if(proStatus == 1) {
                  element.removeClass('fa-eye-slash').addClass('fa-eye').css('color', 'green').data('status', 0);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Hiển thị sản phẩm thành công!'
                  });
                } 
                else {
                  element.removeClass('fa-eye').addClass('fa-eye-slash').css('color', 'red').data('status', 1);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Ẩn sản phẩm thành công!'
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