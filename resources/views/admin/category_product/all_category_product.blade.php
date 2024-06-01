@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
    </div>
    <div class="table-responsive">
    <?php
        $message = Session::get('message'); // hàm get để lấy biến có tên là 'message' ở bên AdminController
        if($message){ // neu ton tai message
            echo '<span class="text-alert">'.$message.'</span>' ; // in ra tin nhan
            Session::put('message',null); //cho hien thi 1 lan thoi
        }
    ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            
            <th>Tên danh mục</th>
            <th>Hiển thị</th>
            <!-- <th>Ngày thêm</th> -->
            <th style="width:90px;">Thao tác</th>
          </tr>
        </thead>
        <tbody>
            @foreach($cate_product as $key => $cate_pro)
          <tr>
            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">                
                @if($cate_pro->category_status ==1) <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><i style="color:green" class="fa-solid fa-eye"></i></a>          
                @else <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><i style="color:red" class="fa-solid fa-eye-slash"></i></a>          
              
                @endif
            </span></td>
            <td>
                <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" style="font-size:16px" class="active" ui-toggle-class=""><i class="fa-solid fa-pen-to-square"></i></a>
                <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này không ?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" style="font-size:16px" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <!-- import data -->
      <!-- <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf 
          <input type="file" name="file" accept=".xlsx"><br>
          <input type="submit" value="Import CSV" name="import_csv" class="btn btn-warning">
      </form> -->
      <!-- export data -->
      <!-- <form action="{{url('export-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf 
          <input type="submit" value="Export CSV" name="import_csv" class="btn btn-success">
      </form> -->
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <!-- <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li> -->
            {!!$cate_product->links()!!}

          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection