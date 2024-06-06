@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
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
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle; width:50px;"></th>
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle;" >STT</th>
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle;" >Tên danh mục</th>
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle;" >Hiển thị</th>
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle;" >Thao tác</th>
              <th  style=" display: table-cell; text-align: center;  vertical-align: middle; width:50px;"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cate_product as $key => $cate_pro)
          <tr>
            <td></td>
            <td style=" display: table-cell; text-align: center; vertical-align: middle;">{{$key+1 }}</td>
            <td style=" display: table-cell; text-align: center; vertical-align: middle;">{{$cate_pro->category_name }}</td>
            <td style=" display: table-cell; text-align: center; vertical-align: middle;">
                <span class="text-ellipsis">
                  @if($cate_pro->category_status == 1) 
                    <i style="color:green; cursor: pointer" class="fa-solid fa-eye update-cate-pro-status" data-id="{{$cate_pro->category_id}}" data-status="0"></i>          
                  @else 
                    <i style="color:red; cursor: pointer" class="fa-solid fa-eye-slash update-cate-pro-status" data-id="{{$cate_pro->category_id}}" data-status="1"></i>          
                  @endif
                </span>
            </td>
            <td style=" display: table-cell; text-align: center; vertical-align: middle;">
            <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
              <i class="fa-solid fa-pen-to-square"></i></a>                <a onclick="return confirm('Bạn có chắc là muốn XÓA danh mục sản phẩm này không?')" href="{{ URL::to('/delete-category-product/'.$cate_pro->category_id) }}" class="active styling-edit" ui-toggle-class=""> <i class="fa fa-times text-danger text"></i></a>
            </td>
            <td></td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('.update-cate-pro-status').click(function(event){
        event.preventDefault();
        var cateproId = $(this).data('id'); // lấy ID bài viết
        var cateproStatus = $(this).data('status'); // lấy trạng thái mới
        var element = $(this);
        $.ajax({
            url: "{{ url('/update-cate-product-status') }}", // đường dẫn tới route xử lý cập nhật
            method: 'GET',
            data:{product_id: cateproId, product_status: cateproStatus},
            success:function(data){              
                if(cateproStatus == 1) {
                  element.removeClass('fa-eye-slash').addClass('fa-eye').css('color', 'green').data('status', 0);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Hiển thị danh mục sản phẩm thành công!'
                  });
                } 
                else {
                  element.removeClass('fa-eye').addClass('fa-eye-slash').css('color', 'red').data('status', 1);
                  Swal.fire({
                    icon: 'success',
                    title: 'Thành công',
                    text: 'Ẩn danh mục sản phẩm thành công!'
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