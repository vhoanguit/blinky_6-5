@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                @foreach ($product_info as $key => $pro)
                    Thư viện ảnh
            </div>
            <br>
            <form method="POST" action="{{ URL('/insert-gallery/' . $product_id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-3" align="right">
                        <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" height="100" width="100"
                            style="object-fit: cover">
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <input type="file" class="form-control" name="file[]" multiple style="margin-top: 5px">
                        <br>
                        <input type="submit" name="upload" value="Tải ảnh" class="btn btn-success btn-m">
                        <?php
                        $message = Session::get('message'); // hàm get để lấy biến có tên là 'message' ở bên AdminController
                        if ($message) {
                            // neu ton tai message
                            echo '<span class="text-alert">' . $message . '</span>'; // in ra tin nhan
                            Session::put('message', null); //cho hien thi 1 lan thoi
                        }
                        ?>
                    </div>
                    
                </div>
            </form>
            <br><br>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Số thứ tự</th>
                            <th>Tên ảnh</th>
                            <th>Ảnh</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gallery as $key => $image)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $image->gallery_image }}</td>
                                <td><img src="{{ URL::to('public/uploads/gallery/' . $image->gallery_image) }}" height="100"
                                        width="100" style="object-fit: cover"></td>
                                <td>
                                    <a onclick="return confirm('Bạn có chắc là muốn XÓA ảnh này không?')" href="{{ URL::to('/delete-gallery/'.$image->gallery_id) }}" class="active styling-edit" ui-toggle-class=""> <i class="fa fa-times text-danger text"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
@endsection
