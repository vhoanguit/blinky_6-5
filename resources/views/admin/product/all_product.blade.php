@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
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
        <tr style="height: 50px">
              <th style=" display: table-cell; vertical-align: middle; width:50px;">STT</th>
              <th style=" display: table-cell; vertical-align: middle; width: 425px;">Tên sản phẩm</th>
              <th style=" display: table-cell; vertical-align: middle;">Giá</th>
              <th style=" display: table-cell; vertical-align: middle;">Màu sắc</th>
              <th style=" display: table-cell; vertical-align: middle;">Hình ảnh sản phẩm</th>
              <th style=" display: table-cell; vertical-align: middle;">Danh mục sản phẩm</th>
              <th style=" display: table-cell; vertical-align: middle;">Hiển thị</th>
              <th style=" display: table-cell; vertical-align: middle;">Thao tác</th>           
            </tr>
        </thead>
        <tbody>
          @foreach($all_product as $key => $pro)
          <tr>
          <td style=" display: table-cell; text-align: center; vertical-align: middle;">
                {{ ($all_product->currentPage() - 1) * $all_product->perPage() + $key + 1 }}</td>
              <td style=" display: table-cell; vertical-align: middle; ">{{$pro->product_name }}</td>
              <td style=" display: table-cell; vertical-align: middle; ">{{$pro->product_price }}</td>
              <td style=" display: table-cell; vertical-align: middle; ">{{$pro->product_color }}</td>
              <td style=" display: table-cell; text-align: center; vertical-align: middle;"><img src="public/uploads/product/{{$pro->product_image }}" height="100" width="100" style="object-fit: cover"></td>
              <td style=" display: table-cell; text-align: center; vertical-align: middle;">{{$pro->category_name }}</td>
              <td style=" display: table-cell; text-align: center; vertical-align: middle;">
                <span class="text-ellipsis">
                  @if($pro->product_status == 1) 
                      <i style="color:green; cursor:pointer" class="fa-solid fa-eye update-pro-status" data-id="{{$pro->product_id}}" data-status="0"></i>          
                  @else 
                      <i style="color:red; cursor:pointer" class="fa-solid fa-eye-slash update-pro-status" data-id="{{$pro->product_id}}" data-status="1"></i>          
                  @endif
                </span>
              </td>
           
            <td style=" display: table-cell; text-align: center; vertical-align: middle;">
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-pen-to-square"></i></a><br>
              <a onclick="return confirm('Bạn có chắc là muốn xóa sản phẩm này ko?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a><br>
              <a href="{{ URL::to('/add-gallery/'.$pro->product_id) }}" ><i class="fa fa-solid fa-image" style="color: #9E75FF"></i></a><br>
              <a href="{{URL::to('/show-product-details/'.$pro->product_id) }}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-circle-info"></i>                        
            </a><br>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <footer class="panel-footer" style="height: 100px; display: flex; justify-content: center; align-items: center;">
      <div>       
          {{ $all_product->links('pagination::bootstrap-4') }}
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